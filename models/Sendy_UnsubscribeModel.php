<?php
/**
 * Sendy plugin for Craft CMS
 *
 * Sendy Model
 *
 * @author    Superbig
 * @copyright Copyright (c) 2017 Superbig
 * @link      https://superbig.co
 * @package   Sendy
 * @since     1.0.0
 */

namespace Craft;

class Sendy_UnsubscribeModel extends BaseModel
{
    /**
     * @return array
     */
    protected function defineAttributes ()
    {
        return array_merge(parent::defineAttributes(), [
            'email' => [ AttributeType::Email, 'default' => '', 'required' => true ],
        ]);
    }

}