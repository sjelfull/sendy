<?php
/**
 * Sendy plugin for Craft CMS
 *
 * Sendy Controller
 *
 * @author    Superbig
 * @copyright Copyright (c) 2017 Superbig
 * @link      https://superbig.co
 * @package   Sendy
 * @since     1.0.0
 */

namespace Craft;

class SendyController extends BaseController
{

    /**
     * @var    bool|array Allows anonymous access to this controller's actions.
     * @access protected
     */
    protected $allowAnonymous = array(
        'actionSubscribe',
    );

    /**
     */
    public function actionSubscribe ()
    {
        $email        = craft()->request->getRequiredParam('email');
        $name         = craft()->request->getParam('name');
        $customFields = craft()->request->getParam('customFields', [ ]);
        $listId       = craft()->request->getParam('listId');
        $options      = [ ];

        if ( $listId ) {
            $options['listId'] = $listId;
        }

        $model = craft()->sendy->subscribe($email, $name, $customFields, $options = [ ]);

        if ( $model->hasErrors() ) {
            return $this->returnErrors($model);
        }

        $this->returnSuccess($model);
    }

    /**
     * Returns a 'success' response.
     *
     * @param $entry
     *
     * @return void
     */
    private function returnSuccess ($model)
    {
        if ( craft()->request->isAjaxRequest() ) {
            $return['success'] = true;
            $this->returnJson($return);
        }
        else {
            craft()->userSession->setNotice(Craft::t('Submission saved.'));
            $this->redirectToPostedUrl($model);
        }
    }

    public function returnErrors ($model)
    {
        //$errorEvent = new GuestEntriesEvent($this, array( 'entry' => $entry ));
        //craft()->guestEntries->onError($errorEvent);
        if ( craft()->request->isAjaxRequest() ) {
            $this->returnJson(array(
                'sendy' => $model->getErrors(),
            ));
        }
        else {
            craft()->userSession->setError(Craft::t('Couldn’t subscribe.'));
            // Send the sendy input back to the template
            craft()->urlManager->setRouteVariables(array(
                'sendy' => $model
            ));
        }
    }
}