<?php

/**
 * @file plugins/generic/opdoira/classes/OPdoiraSetting.php
 *
 * Copyright (c) 2014-2024 Simon Fraser University
 * Copyright (c) 2003-2024 John Willinsky
 * Distributed under the GNU GPL v3. For full terms see the file docs/COPYING.
 *
 * @class OPdoiraSettings
 *
 * @brief Setting management class to handle schema, fields, validation, etc. for OP DOI RA plugin
 */

namespace APP\plugins\generic\opdoira\classes;

use APP\plugins\generic\opdoira\filter\O4DOIXmlFilter;
use PKP\components\forms\FieldHTML;
use PKP\components\forms\FieldOptions;
use PKP\components\forms\FieldSelect;
use PKP\components\forms\FieldText;
use PKP\context\Context;
use PKP\facades\Locale;

class OPdoiraSettings extends \PKP\doi\RegistrationAgencySettings
{
    public function getSchema(): \stdClass
    {
        return (object) [
            'title' => 'OP DOI RA Plugin',
            'description' => 'Registration agency plugin for OP DOI RA',
            'type' => 'object',
            'required' => [
                'registrantName',
                'fromCompany',
                'fromName',
                'fromEmail',
                'publicationCountry',
                'exportIssuesAs',
            ],
            'properties' => (object) [
                'registrantName' => (object) [
                    'type' => 'string',
                    'validation' => ['max:60']
                ],
                'fromName' => (object) [
                    'type' => 'string',
                    'validation' => ['max:60']
                ],
                'fromCompany' => (object) [
                    'type' => 'string',
                    'validation' => ['max:60']
                ],
                'fromEmail' => (object) [
                    'type' => 'string',
                    'validation' => ['max:90']
                ],
                'publicationCountry' => (object) [
                    'type' => 'string'
                ],
                'exportIssuesAs' => (object) [
                    'type' => 'integer',
                    'validation' => ["in:1,2"]
                ],
                'username' => (object) [
                    'type' => 'string',
                    'validation' => [
                        'nullable',
                        'max:50',
                        'regex:/^[^:]*$/'
                    ]
                ],
                'password' => (object) [
                    'type' => 'string',
                    'validation' => ['nullable', 'max:50']
                ],
                'crEnabled' => (object) [
                    'type' => 'boolean',
                    'validation' => ['nullable']
                ],
                'testMode' => (object) [
                    'type' => 'boolean',
                    'validation' => ['nullable']
                ],
            ],
        ];
    }

    /**
     * @inheritDoc
     */
    public function getFields(Context $context): array
    {
        $countries = [];
        foreach (Locale::getCountries() as $country) {
            $countries[] = [
                'value' => $country->getAlpha2(),
                'label' => $country->getLocalName()
            ];
        }
        usort($countries, function ($a, $b) {
            return strcmp($a['label'], $b['label']);
        });

        $exportIssueOptions = [
            ['value' => O4DOIXmlFilter::O4DOI_ISSUE_AS_WORK, 'label' => __('plugins.importexport.opdoira.settings.form.work')],
            ['value' => O4DOIXmlFilter::O4DOI_ISSUE_AS_MANIFESTATION, 'label' => __('plugins.importexport.opdoira.settings.form.manifestation')],
        ];

        return [
            new FieldHTML('preamble', [
                'label' => __('plugins.importexport.opdoira.settings.label'),
                'description' => $this->_getPreambleText(),
            ]),
            new FieldText('registrantName', [
                'label' => __('plugins.importexport.opdoira.settings.form.registrantName.label'),
                'value' => $this->agencyPlugin->getSetting($context->getId(), 'registrantName'),
                'description' => __('plugins.importexport.opdoira.settings.form.registrantName'),
                'isRequired' => true,
            ]),
            new FieldText('fromName', [
                'label' => __('plugins.importexport.opdoira.settings.form.fromName'),
                'value' => $this->agencyPlugin->getSetting($context->getId(), 'fromName'),
                'description' => __('plugins.importexport.opdoira.settings.form.fromFields'),
                'isRequired' => true,
            ]),
            new FieldText('fromCompany', [
                'label' => __('plugins.importexport.opdoira.settings.form.fromCompany'),
                'value' => $this->agencyPlugin->getSetting($context->getId(), 'fromCompany'),
                'isRequired' => true,
            ]),
            new FieldText('fromEmail', [
                'label' => __('plugins.importexport.opdoira.settings.form.fromEmail'),
                'value' => $this->agencyPlugin->getSetting($context->getId(), 'fromEmail'),
                'isRequired' => true,
            ]),
            new FieldSelect('publicationCountry', [
                'label' => __('common.country'),
                'description' => __('plugins.importexport.opdoira.settings.form.publicationCountry'),
                'options' => $countries,
                'value' => $this->agencyPlugin->getSetting($context->getId(), 'publicationCountry'),
                'isRequired' => true,
            ]),
            new FieldSelect('exportIssuesAs', [
                'label' => __('plugins.importexport.opdoira.settings.form.exportIssuesAs.label'),
                'description' => __('plugins.importexport.opdoira.settings.form.exportIssuesAs'),
                'options' => $exportIssueOptions,
                'value' => $this->agencyPlugin->getSetting($context->getId(), 'exportIssuesAs'),
                'isRequired' => true,
            ]),
            new FieldText('username', [
                'label' => __('plugins.importexport.opdoira.settings.form.username'),
                'value' => $this->agencyPlugin->getSetting($context->getId(), 'username'),
            ]),
            new FieldText('password', [
                'label' => __('plugins.importexport.common.settings.form.password'),
                'description' => __('plugins.importexport.common.settings.form.password.description'),
                'inputType' => 'password',
                'value' => $this->agencyPlugin->getSetting($context->getId(), 'password'),
            ]),
            new FieldOptions('crEnabled', [
                'label' => __('plugins.importexport.opdoira.crossref.label'),
                'options' => [
                    ['value' => true, 'label' => __('plugins.importexport.opdoira.crossref')],
                ],
                'value' => $this->agencyPlugin->getSetting($context->getId(), 'crEnabled'),
            ]),
            new FieldOptions('testMode', [
                'label' => __('plugins.importexport.common.settings.form.testMode.label'),
                'options' => [
                    ['value' => true, 'label' => __('plugins.importexport.opdoira.settings.form.testMode.description')],
                ],
                'value' => $this->agencyPlugin->getSetting($context->getId(), 'testMode'),
            ]),
        ];
    }

    protected function _getPreambleText(): string
    {
        $text = '';
        $text .= '<p>' . __('plugins.importexport.opdoira.settings.description') . '</p>';
        $text .= '<p>' . __('plugins.importexport.opdoira.intro') . '</p>';
        return $text;
    }
}
