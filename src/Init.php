<?php
/**
 * Init class.
 *
 * @package    Perspective
 * @subpackage API
 * @author     Squiz Pty Ltd <products@squiz.net>
 * @copyright  2019 Squiz Pty Ltd (ABN 77 084 670 600)
 */

namespace PerspectiveAPI;

/**
 * Init class.
 */
class Init
{


    /**
     * Sets class alias for Connector class.
     *
     * @param string $originalClass Fully namespaces class name to be an alias.
     *
     * @return boolean
     * @throws \Exception Thrown when original class does not exist.
     */
    final public static function setConnectorAlias(string $orignalClass)
    {
        if (class_exists($orignalClass) === false) {
            throw new \Exception('Failed to set Connector alias since the original class does not exist');
        }

        return class_alias($orignalClass, 'PerspectiveAPI\Connector');

    }//end setConnectorAlias()


}//end class
