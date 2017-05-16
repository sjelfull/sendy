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

class Sendy_SubscribeModel extends BaseModel
{
    public function __construct ($attributes = [ ])
    {
        parent::__construct($attributes);
    }

    /**
     * @return array
     */
    protected function defineAttributes ()
    {
        return array_merge(parent::defineAttributes(), [
            'name'         => [ AttributeType::String, 'default' => null ],
            'email'        => [ AttributeType::Email, 'default' => '', 'required' => true ],
            'customFields' => [ AttributeType::Mixed, 'default' => [ ] ],
        ]);
    }

}