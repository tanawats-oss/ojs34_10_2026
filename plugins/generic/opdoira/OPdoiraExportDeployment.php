<?php
/**
 * @file plugins/generic/opdoira/OPdoiraExportDeployment.php
 *
 * Copyright (c) 2014-2024 Simon Fraser University
 * Copyright (c) 2000-2024 John Willinsky
 * Distributed under the GNU GPL v3. For full terms see the file docs/COPYING.
 *
 * @class OPdoiraExportDeployment
 *
 * @brief Base class configuring the OP DOI RA export process to an
 * application's specifics.
 */

namespace APP\plugins\generic\opdoira;

use APP\plugins\PubObjectCache;
use APP\plugins\generic\opdoira\OPdoiraExportPlugin;
use PKP\context\Context;


class OPdoiraExportDeployment
{
    public const OPDOIRA_XMLNS = 'http://www.editeur.org/onix/DOIMetadata/2.0';
    public const OPDOIRA_XMLNS_XSI = 'http://www.w3.org/2001/XMLSchema-instance';
    public const OPDOIRA_XSI_SCHEMAVERSION = '2.0';
    public const OPDOIRA_XSI_SCHEMALOCATION = 'http://ra.publications.europa.eu/schema/onix/DOIMetadata/2.0/ONIX_DOIMetadata_2.0.xsd';
    public const OPDOIRA_XSI_SCHEMALOCATION_DEV = 'http://ra-publications-dev.medra.org/schema/onix/DOIMetadata/2.0/ONIX_DOIMetadata_2.0.xsd';

    /**
     * Get the plugin cache
     */
    function getCache(): PubObjectCache
    {
        return $this->plugin->getCache();
    }

    function __construct(
        public Context $context,
        public OPdoiraExportPlugin $plugin
    ) {}

    //
    // Deployment items for subclasses to override
    //
    /**
     * Get the namespace URN
     */
    function getNamespace(): string
    {
        return self::OPDOIRA_XMLNS;
    }

    /**
     * Get the schema instance URN
     */
    function getXmlSchemaInstance(): string
    {
        return self::OPDOIRA_XMLNS_XSI;
    }

    /**
     * Get the schema version
     */
    function getXmlSchemaVersion(): string
    {
        return self::OPDOIRA_XSI_SCHEMAVERSION;
    }

    /**
     * Get the schema location URL
     */
    function getXmlSchemaLocation(): string
    {
        return $this->plugin->isTestMode($this->context) ? self::OPDOIRA_XSI_SCHEMALOCATION_DEV : self::OPDOIRA_XSI_SCHEMALOCATION;
    }

    /**
     * Get the schema filename.
     */
    function getSchemaFilename(): string
    {
        return $this->getXmlSchemaLocation();
    }

    /**
     * Get the import/export context.
     */
    function getContext(): Context
    {
        return $this->context;
    }

    /**
     * Get the import/export plugin.
     */
    function getPlugin(): OPdoiraExportPlugin
    {
        return $this->plugin;
    }
}
