<?php

/**
 * @file plugins/generic/opdoira/OPdoiraExportPlugin.php
 *
 * Copyright (c) 2014-2024 Simon Fraser University
 * Copyright (c) 2003-2024 John Willinsky
 * Distributed under the GNU GPL v3. For full terms see the file docs/COPYING.
 *
 * @class OPdoiraExportPlugin
 *
 * @brief OP DOI RA Onix for DOI (O4DOI) export/registration plugin.
 */

namespace APP\plugins\generic\opdoira;

use APP\core\Application;
use APP\facades\Repo;
use APP\issue\Issue;
use APP\plugins\DOIPubIdExportPlugin;
use APP\plugins\generic\opdoira\classes\OPdoiraWebservice;
use APP\publication\Publication;
use APP\submission\Submission;
use DOMDocument;
use Exception;
use PKP\context\Context;
use PKP\core\DataObject;
use PKP\doi\Doi;
use PKP\facades\Locale;
use PKP\file\FileManager;
use PKP\file\TemporaryFileManager;
use PKP\i18n\LocaleConversion;


class OPdoiraExportPlugin extends DOIPubIdExportPlugin
{
    public function __construct(protected OPdoiraPlugin $agencyPlugin)
    {
        parent::__construct();
    }

    /**
     * @copydoc Plugin::getName()
     */
    public function getName()
    {
        return 'OPdoiraExportPlugin';
    }

    /**
     * @copydoc Plugin::getDisplayName()
     */
    public function getDisplayName()
    {
        return __('plugins.importexport.opdoira.displayName');
    }

    /**
     * @copydoc Plugin::getDescription()
     */
    public function getDescription()
    {
        return __('plugins.importexport.opdoira.description');
    }

    /**
     * @copydoc PubObjectsExportPlugin::getSubmissionFilter()
     */
    public function getSubmissionFilter()
    {
        return 'article=>opdoira-xml';
    }

    /**
     * @copydoc PubObjectsExportPlugin::getIssueFilter()
     */
    public function getIssueFilter()
    {
        return 'issue=>opdoira-xml';
    }

    /**
     * @copydoc PubObjectsExportPlugin::getRepresentationFilter()
     */
    public function getRepresentationFilter()
    {
        return 'galley=>opdoira-xml';
    }

    /**
     * @copydoc ImportExportPlugin::getPluginSettingsPrefix()
     */
    public function getPluginSettingsPrefix()
    {
        return 'opdoira';
    }

    /**
     * @copydoc DOIPubIdExportPlugin::getSettingsFormClassName()
     */
    public function getSettingsFormClassName()
    {
        throw new Exception('DOI settings no longer managed via plugin settings form.');
    }

    /**
     * @copydoc PubObjectsExportPlugin::getExportDeploymentClassName()
     */
    public function getExportDeploymentClassName()
    {
        return '\APP\plugins\generic\opdoira\OPdoiraExportDeployment';
    }

    /**
     * @copydoc PubObjectsExportPlugin::getStatusMessage()
     */
    public function getStatusMessage($request)
    {
        $articleId = $request->getUserVar('articleId');
        $article = Repo::submission()->get((int)$articleId);
        $failedMsg = $article->getData('doiObject')->getData($this->agencyPlugin->getFailedMsgSettingName());
        if (!empty($failedMsg)) {
            return $failedMsg;
        }
    }

    /**
     * Exports and stores XML as a TemporaryFile
     *
     * @param DataObject[] $objects
     *
     * @throws Exception
     */
    public function exportAsDownload(
        Context $context,
        array $objects,
        string $filter,
        string $objectsFileNamePart,
        ?bool $noValidation = null,
        ?array &$exportErrors = null
    ): ?int {
        $fileManager = new TemporaryFileManager();

        $exportErrors = [];
        $exportXml = $this->exportXML($objects, $filter, $context, $noValidation, $exportErrors);

        $exportFileName = $this->getExportFileName($this->getExportPath(), $objectsFileNamePart, $context, '.xml');

        $fileManager->writeFile($exportFileName, $exportXml);

        $user = Application::get()->getRequest()->getUser();

        return $fileManager->createTempFileFromExisting($exportFileName, $user->getId());
    }

    /**
     * Exports and registers XML for each Submission or Issue with OP DOI RA.
     *
     * @param DataObject[] $objects
     */
    public function exportAndDeposit(
        Context $context,
        array $objects,
        string $filter,
        string &$responseMessage,
        ?bool $noValidation = null
    ): bool {

        $fileManager = new FileManager();
        $resultErrors = [];

        // Errors occurred will be accessible via the status link
        // thus do not display all errors notifications (for every article),
        // just one general.
        $errorsOccurred = false;
        // In order to get and save the errors for each object,
        // we will deposit object by object.
        // The export however supports bulk/batch object export, thus
        // also the filter expects an array of objects.
        // Thus the foreach loop, but every object will be in an one item array for
        // the export and filter to work.
        foreach ($objects as $object) {
            /** @var Submission|Issue $object */
            // Get the XML
            $exportErrors = [];
            $exportXml = $this->exportXML([$object], $filter, $context, $noValidation, $exportErrors);
            // Write the XML to a file.
            // export file name example: opdoira-20160723-160036-articles-1-1.xml
            $objectFileNamePart = $this->_getObjectFileNamePart($object);
            $exportFileName = $this->getExportFileName($this->getExportPath(), $objectFileNamePart, $context, '.xml');
            $fileManager->writeFile($exportFileName, $exportXml);
            // Deposit the XML file.
            $result = $this->depositXML($object, $context, $exportFileName);

            if (!$result) {
                $errorsOccurred = true;
            }
            if (is_array($result)) {
                $resultErrors[] = $result;
            }
            // Remove all temporary files.
            $fileManager->deleteByPath($exportFileName);
        }
        // Prepare response message and return status
        if (empty($resultErrors)) {
            if ($errorsOccurred) {
                $responseMessage = 'plugins.generic.opdoira.deposit.unsuccessful';
                return false;
            } else {
                $responseMessage = $this->getDepositSuccessNotificationMessageKey();
                return true;
            }
        } else {
            $responseMessage = 'api.dois.400.depositFailed';
            return false;
        }
    }

    /**
     * Registers XML with OP DOI RA.
     *
     * @see PubObjectsExportPlugin::depositXML()
     * @param Submission|Issue $objects
     */
    public function depositXML($objects, $context, $filename)
    {
        // Use a different endpoint for testing and production.
        // New endpoint: use a different endpoint if the user selected the checkbox to deposit also in Crossref.
        $crEnabled = $this->getSetting($context->getId(), 'crEnabled');
        $endpoint =
            ($this->isTestMode($context) ?
                ($crEnabled ? OPdoiraWebservice::OPDOIRA2CR_WS_ENDPOINT_DEV : OPdoiraWebservice::OPDOIRA_WS_ENDPOINT_DEV) :
                ($crEnabled ? OPdoiraWebservice::OPDOIRA2CR_WS_ENDPOINT : OPdoiraWebservice::OPDOIRA_WS_ENDPOINT));

        // Get credentials.
        $username = $this->getSetting($context->getId(), 'username');
        $password = $this->getSetting($context->getId(), 'password');
        // Retrieve the XML.
        $xml = file_get_contents($filename);

        // Get the current user locale to get the Crossref service validation error messages in that language
        // Currently only OP DOI RA supported: eng
        $language = 'eng';
        $supportedLanguages = array('eng');
        $user3LetterLang = LocaleConversion::get3LetterIsoFromLocale(Locale::getLocale());
        if (in_array($user3LetterLang, $supportedLanguages)) {
            $language = $user3LetterLang;
        }

        // Instantiate the OP DOI RA web service wrapper.
        $ws = new OPdoiraWebservice($endpoint, $username, $password);
        // Register the XML with OP DOI RA (upload) or also with Crossref (deposit)
        $result = $crEnabled ? $ws->deposit($xml, $language) : $ws->upload($xml);

        if ($result === true) {
            $this->_updateDepositStatus($objects, Doi::STATUS_REGISTERED);
            return true;
        } else {
            if (!is_string($result)) return false; // When is this happening?
            // Handle errors.
            $doc = new DOMDocument();
            $doc->loadXML($result);
            $statusCode = $doc->getElementsByTagName('statusCode');
            if ($statusCode->length > 0 && $statusCode->item(0)->textContent == 'FAILED') {
                $errNo = $doc->getElementsByTagName('errorsNumber')->item(0)->textContent;
                $errNodeList = $doc->getElementsByTagName('error');
                $errors = array();
                foreach($errNodeList as $errNode) {
                    $error = array();
                    if($errNode->childNodes->length) {
                        foreach($errNode->childNodes as $errChildNode) {
                            $error[$errChildNode->nodeName] = $errChildNode->nodeValue;
                        }
                    }
                    $errors[] = $error;
                }
                $status = Doi::STATUS_ERROR;
                $errorMsg = $this->buildDepositErrorMsg($errNo, $errors, $xml);
                $this->_updateDepositStatus($objects, $status, $errorMsg);
                return false; // or a message?
            }
            $status = Doi::STATUS_ERROR;
            $this->_updateDepositStatus($objects, $status, $result);
            return array(
                array('plugins.importexport.common.register.error.mdsError', $result)
            );
        }
    }

    /** Proxy to main plugin class's getSetting method */
    public function getSetting($contextId, $name)
    {
        return $this->agencyPlugin->getSetting($contextId, $name);
    }

    /**
     * Update stored DOI status based on if deposits and registration have been successful
     *
     * @param Submission|Issue $object
     */
    private function _updateDepositStatus(DataObject $object, string $status, string $failedMsg = null)
    {
        if ($object instanceof Submission) {
            $object = $object->getCurrentPublication();
        }
        /** @var Publication|Issue $object */
        /** @var Doi $doiObject */
        $doiObject = $object->getData('doiObject');
        $editParams = [
            'status' => $status,
            // Sets new failedMsg or resets to null for removal of previous message
            $this->agencyPlugin->getFailedMsgSettingName() => $failedMsg,
        ];
        if ($status == Doi::STATUS_REGISTERED) {
            $editParams['registrationAgency'] = $this->getName();
        }
        Repo::doi()->edit($doiObject, $editParams);
    }

    /**
     * Build special deposit error message - to provide the similar functionality as the earlier plugins.
     */
    public function buildDepositErrorMsg(string $errNo, array $errors, string $xml): string
    {
        $errorMsg =
            __('plugins.importexport.opdoira.crossref.error.cause') . PHP_EOL .
            __('plugins.importexport.opdoira.crossref.error.number') . ': ' . $errNo . PHP_EOL .
            __('plugins.importexport.opdoira.crossref.error.details') . ': ' . PHP_EOL . PHP_EOL;

            foreach ($errors as $error) {
                $errorMsg .=
                    __('plugins.importexport.opdoira.crossref.error.code') . ': ' . $error['code'] . PHP_EOL .
                    __('plugins.importexport.opdoira.crossref.error.element') . ': ' . $error['reference'] . PHP_EOL .
                    __('plugins.importexport.opdoira.crossref.error.description') . ': ' . $error['description'] . PHP_EOL . PHP_EOL ;
            }

            $errorMsg .=
                __("plugins.importexport.common.invalidXML") . ': ' . PHP_EOL .
                $xml .
                PHP_EOL;
        return $errorMsg;
    }



    /**
     * Get the object file name part.
     *
     * @param Submission|Issue $object
     */
    private function _getObjectFileNamePart(DataObject $object): string
    {
        if ($object instanceof Submission) {
            return 'articles-' . $object->getId();
        } elseif ($object instanceof Issue) {
            return 'issues-' . $object->getId();
        } else {
            return '';
        }
    }
}
