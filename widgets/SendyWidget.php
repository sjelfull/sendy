<?php
/**
 * Sendy plugin for Craft CMS
 *
 * Sendy Widget
 *
 * @author    Superbig
 * @copyright Copyright (c) 2017 Superbig
 * @link      https://superbig.co
 * @package   Sendy
 * @since     1.0.0
 */
namespace Craft;
class SendyWidget extends BaseWidget
{
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
    public function getBodyHtml ()
    {
        // Include our Javascript & CSS
        craft()->templates->includeCssResource('sendy/css/widgets/SendyWidget.css');
        craft()->templates->includeJsResource('sendy/js/widgets/SendyWidget.js');
        /* -- Variables to pass down to our rendered template */
        $variables             = array();
        $variables['settings'] = $this->getSettings();

        return craft()->templates->render('sendy/widgets/SendyWidget_Body', $variables);
    }

    /**
     * @return int
     */
    public function getColspan ()
    {
        return 1;
    }

    /**
     * @return array
     */
    protected function defineSettings ()
    {
        return array(
            'apiKey'        => array( AttributeType::String, 'label' => 'API key', 'default' => '' ),
            'defaultListId' => array( AttributeType::String, 'label' => 'Default list ID', 'default' => '' ),
        );
    }

    /**
     * @return mixed
     */
    public function getSettingsHtml ()
    {

        /* -- Variables to pass down to our rendered template */

        $variables             = array();
        $variables['settings'] = $this->getSettings();

        return craft()->templates->render('sendy/widgets/SendyWidget_Settings', $variables);
    }

    /**
     * @param mixed $settings The Widget's settings
     *
     * @return mixed
     */
    public function prepSettings ($settings)
    {

        /* -- Modify $settings here... */

        return $settings;
    }
}