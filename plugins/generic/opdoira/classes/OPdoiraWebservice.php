<?php

/**
 * @file plugins/generic/opdoira/classes/OPdoiraWebservice.php
 *
 * Copyright (c) 2014-2024 Simon Fraser University
 * Copyright (c) 2003-2024 John Willinsky
 * Distributed under the GNU GPL v3. For full terms see the file docs/COPYING.
 *
 * @class OPdoiraWebservice
 *
 * @brief A wrapper for the OP DOI RA web service 2.0.
 *
 */

namespace APP\plugins\generic\opdoira\classes;

use APP\core\Application;
use DOMDocument;
use PKP\core\PKPString;
use PKP\xml\XMLNode;


class OPdoiraWebservice
{
    public const OPDOIRA_WS_ENDPOINT_DEV = 'https://ra-publications-dev.medra.org/servlet/ws/opoceWS';
    public const OPDOIRA2CR_WS_ENDPOINT_DEV = 'https://ra-publications-dev.medra.org/servlet/ws/CRProxy';
    public const OPDOIRA_WS_ENDPOINT = 'https://ra.publications.europa.eu/servlet/ws/opoceWS';
    public const OPDOIRA2CR_WS_ENDPOINT = 'https://ra.publications.europa.eu/servlet/ws/CRProxy';
    public const OPDOIRA_WS_RESPONSE_OK  = 200;

    /** HTTP authentication credentials. */
    public array $_auth;

    /** The OP DOI RA web service endpoint. */
    public string $_endpoint;

    /**
     * Constructor
     */
    function __construct(string $endpoint, string $login, string $password)
    {
        $this->_endpoint = $endpoint;
        $this->_auth = [$login, $password];
    }

    /**
     * OP DOI RA upload operation.
     *
     * @return bool|string True for success, an error message otherwise.
    */
    function upload(string $xml): bool|string
    {
        $attachmentId = $this->_getContentId('metadata');
        $attachment = array($attachmentId => $xml);
        $arg = "<med:contentID href=\"$attachmentId\" />";
        return $this->_doRequest('upload', $arg, $attachment);
    }

    /**
     * OP DOI RA deposit operation, includes the deposit to Crossref.
     *
     * @return bool|string True for success, an error message otherwise.
     */
    function deposit(string $xml, string $lang = 'eng', string $accessMode = '01'): bool|string
    {
        $attachmentId = $this->_getContentId('metadata');
        $attachment = array($attachmentId => $xml);
        $arg = "<med:accessMode>" . $accessMode . "</med:accessMode>" .
            "<med:language>" .$lang . "</med:language>" .
            "<med:contentID>" . $attachmentId . "</med:contentID>";
        return $this->_doRequest('deposit', $arg, $attachment);
    }

    /**
     * OP DOI RA viewMetadata operation
     */
    function viewMetadata($doi): bool|string
    {
        $doi = $this->_escapeXmlEntities($doi);
        $arg = "<med:doi>$doi</med:doi>";
        return $this->_doRequest('viewMetadata', $arg);
    }

    /**
     * Do the actual web service request.
     *
     * @return bool|string True for success, an error message otherwise.
     */
    function _doRequest(string $action, string $arg, array $attachment = null): bool|string
    {
        // Build the multipart SOAP message from scratch.
        $soapMessage =
            '<SOAP-ENV:Envelope xmlns:SOAP-ENV="http://schemas.xmlsoap.org/soap/envelope/" ' .
                    'xmlns:med="http://www.medra.org">' .
                '<SOAP-ENV:Header/>' .
                '<SOAP-ENV:Body>' .
                    "<med:$action>$arg</med:$action>" .
                '</SOAP-ENV:Body>' .
            '</SOAP-ENV:Envelope>';

        $soapMessageId = $this->_getContentId($action);
        if ($attachment) {
            assert(count($attachment) == 1);
            $request =
                "--MIME_boundary\r\n" .
                $this->_getMimePart($soapMessageId, $soapMessage) .
                "--MIME_boundary\r\n" .
                $this->_getMimePart(key($attachment), current($attachment)) .
                "--MIME_boundary--\r\n";
            $contentType = 'multipart/related; type="text/xml"; boundary="MIME_boundary"';
        } else {
            $request = $soapMessage;
            $contentType = 'text/xml';
        }

        $httpClient = Application::get()->getHttpClient();
        $result = true;
        $document = new DOMDocument();
        // Make SOAP request.
        try {
            $response = $httpClient->request('POST', $this->_endpoint, [
                'auth' => $this->_auth,
                'headers' => [
                    'SOAPAction' => $action,
                    'Content-Type' => $contentType,
                    'UserAgent' => 'OJS-OP DOI RA',
                ],
                'body' => $request,
            ]);
        } catch (\GuzzleHttp\Exception\RequestException $e) {
            $result = $e->getMessage();
            if ($e->hasResponse()) {
                $exceptionResponseContent = $e->getResponse()->getBody()->getContents();
                $result = $exceptionResponseContent;
                $document->loadXml($exceptionResponseContent);
                $faultstring = $document->getElementsByTagName('faultstring');
                if ($faultstring->length > 0) {
                    $result = 'OP DOI RA: ' . $e->getResponse()->getStatusCode() . ' - ' . $faultstring->item(0)->textContent;
                }
            }
            return $result;
        }

        if (($status = $response->getStatusCode()) != self::OPDOIRA_WS_RESPONSE_OK) {
            $result = 'OJS-OP DOI RA: Expected ' . self::OPDOIRA_WS_RESPONSE_OK . ' response code, got ' . $status . ' instead.';
        } else {
            $responseContent = $response->getBody()->getContents();
            if (!$attachment && $action == 'viewMetadata') {
                $parts = explode("\r\n\r\n", $responseContent);
                $result = array_pop($parts);
                $result = PKPString::regexp_replace('/>[^>]*$/', '>', $result);
            } else {
                $document->loadXml($responseContent);
                $returnCode = $document->getElementsByTagName('returnCode');
                $statusCode = $document->getElementsByTagName('statusCode');
                if (($returnCode->length > 0 && $returnCode->item(0)->textContent != 'success') ||
                    ($statusCode->length > 0 && $statusCode->item(0)->textContent != 'SUCCESS')) {
                        $result = $responseContent;
                }
            }
        }
        return $result;
    }

    /**
     * Create a mime part with the given content.
     */
    function _getMimePart(string $contentId, string $content): string
    {
        return
            "Content-Type: text/xml; charset=utf-8\r\n" .
            "Content-ID: <$contentId>\r\n" .
            "\r\n" .
            $content . "\r\n";
    }

    /**
     * Create a globally unique MIME content ID.
     */
    function _getContentId(string $prefix): string
    {
        return $prefix . md5(uniqid()) . '@publications.europa.eu';
    }

    /**
     * Escape XML entities.
     */
    function _escapeXmlEntities(string $string): string
    {
        return XMLNode::xmlentities($string);
    }
}
