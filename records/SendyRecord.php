<?php
/**
 * Sendy plugin for Craft CMS
 *
 * Sendy Record
 *
 * @author    Superbig
 * @copyright Copyright (c) 2017 Superbig
 * @link      https://superbig.co
 * @package   Sendy
 * @since     1.0.0
 */

namespace Craft;

class SendyRecord extends BaseRecord
{
    /**
     * @return string
     */
    public function getTableName()
    {
        return 'sendy';
    }

    /**
     * @access protected
     * @return array
     */
   protected function defineAttributes()
    {
        return array(
            'someField'     => array(AttributeType::String, 'default' => ''),
        );
    }

    /**
     * @return array
     */
    public function defineRelations()
    {
        return array(
        );
    }
}