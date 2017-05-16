<?php
/**
 * Sendy plugin for Craft CMS
 *
 * Sendy Service
 *
 * @author    Superbig
 * @copyright Copyright (c) 2017 Superbig
 * @link      https://superbig.co
 * @package   Sendy
 * @since     1.0.0
 */

namespace Craft;

use SendyPHP\Sendy;

class SendyService extends BaseApplicationComponent
{
    protected $settings = null;
    protected $sendy;

    public function init ()
    {
        parent::init();

        $installationUrl = $this->getSetting('installationUrl');
        $apiKey          = $this->getSetting('apiKey');
        $this->sendy     = new Sendy($installationUrl, $apiKey);
    }

    /**
     */
    public function subscribe ($email, $name = null, $customFields = [ ], $options = [ ])
    {
        $listId = $this->getSetting('defaultListId');

        $model = new Sendy_SubscribeModel();
        $model->setAttribute('email', $email);
        $model->setAttribute('name', $name);
        $model->setAttribute('customFields', $customFields);

        if ( isset($options['listId']) ) {
            $listId = $options['listId'];
        }

        if ( $model->validate() ) {

            $statusMessage = '';
            try {
                $status = $this->sendy->subscribe($listId, $email, $name, $customFields, $statusMessage);

                if ( !$status ) {
                    $model->addError('server', Craft::t($statusMessage));
                }

            }
            catch (\SendyPHP\Exception $e) {
                $model->addError('server', Craft::t($e->getMessage()));

                return $model;
            }
        }

        return $model;
    }

    public function unsubscribe ($email, $options = [ ])
    {
        $listId = $this->getSetting('defaultListId');

        $model = new Sendy_UnsubscribeModel();
        $model->setAttribute('email', $email);

        if ( isset($options['listId']) ) {
            $listId = $options['listId'];
        }

        if ( $model->validate() ) {

            $statusMessage = '';
            try {
                $status = $this->sendy->unsubscribe($listId, $email, $statusMessage);

                if ( !$status ) {
                    $model->addError('server', Craft::t($statusMessage));
                }

            }
            catch (\SendyPHP\Exception $e) {
                $model->addError('server', Craft::t($e->getMessage()));
            }
        }
        else {

        }

        return $model;
    }

    public function getActiveSubscriberCount ($options = [ ])
    {
        $listId = $this->getSetting('defaultListId');

        if ( isset($options['listId']) ) {
            $listId = $options['listId'];
        }

        $statusMessage = '';
        try {
            $count = $this->sendy->getActiveSubscriberCount($listId, $statusMessage);

            return $count;

        }
        catch (\SendyPHP\Exception $e) {
            return false;
        }
    }

    public function getSetting ($key)
    {
        if ( !$this->settings ) {
            $plugin         = craft()->plugins->getPlugin('sendy');
            $this->settings = $plugin->getSettings();
        }

        return $this->settings->$key;
    }
}