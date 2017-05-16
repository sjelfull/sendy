<?php
/**
 * Sendy plugin for Craft CMS
 *
 * Send newsletters, 100x cheaper
 *
 * @author    Superbig
 * @copyright Copyright (c) 2017 Superbig
 * @link      https://superbig.co
 * @package   Sendy
 * @since     1.0.0
 */

namespace Craft;

class SendyPlugin extends BasePlugin
{
    /**
     * @return mixed
     */
    public function init ()
    {
        parent::init();

        require_once __DIR__ . '/vendor/autoload.php';
    }

    /**
     * @return mixed
     */
    public function getName ()
    {
        return Craft::t('Sendy');
    }

    /**
     * @return mixed
     */
    public function getDescription ()
    {
        return Craft::t('Send newsletters, 100x cheaper');
    }

    /**
     * @return string
     */
    public function getDocumentationUrl ()
    {
        return 'https://github.com/sjelfull/sendy/blob/master/README.md';
    }

    /**
     * @return string
     */
    public function getReleaseFeedUrl ()
    {
        return 'https://raw.githubusercontent.com/sjelfull/sendy/master/releases.json';
    }

    /**
     * @return string
     */
    public function getVersion ()
    {
        return '1.0.0';
    }

    /**
     * @return string
     */
    public function getSchemaVersion ()
    {
        return '1.0.0';
    }

    /**
     * @return string
     */
    public function getDeveloper ()
    {
        return 'Superbig';
    }

    /**
     * @return string
     */
    public function getDeveloperUrl ()
    {
        return 'https://superbig.co';
    }

    /**
     * @return bool
     */
    public function hasCpSection ()
    {
        return false;
    }

    /**
     * @return array
     */
    protected function defineSettings ()
    {
        return array(
            'installationUrl' => array( AttributeType::String, 'label' => 'Installation URL', 'default' => '' ),
            'apiKey'          => array( AttributeType::String, 'label' => 'API key', 'default' => '' ),
            'defaultListId'   => array( AttributeType::String, 'label' => 'Default list ID', 'default' => '' ),
            //'customFields'    => array( AttributeType::Mixed, 'label' => 'Custom fields', 'default' => [ ] ),
        );
    }

    /**
     * @return mixed
     */
    public function getSettingsHtml ()
    {
        return craft()->templates->render('sendy/Sendy_Settings', array(
            'settings' => $this->getSettings()
        ));
    }

}