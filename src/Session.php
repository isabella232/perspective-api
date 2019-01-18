<?php
/**
 * Session base class.
 *
 * @package    Perspective
 * @subpackage API
 * @author     Squiz Pty Ltd <products@squiz.net>
 * @copyright  2019 Squiz Pty Ltd (ABN 77 084 670 600)
 */

namespace PerspectiveAPI;

/**
 * Session class.
 */
class Session
{


    /**
     * Gets session value.
     *
     * @param string $key Key of the value to get.
     *
     * @return mixed
     */
    public static function getValue(string $key) {
        return \PerspectiveAPI\Connector::getSessionValue($key);

    }//end getValue()


    /**
     * Sets session value.
     *
     * @param string $key   Key of the value to get.
     * @param mixed  $value The value to set.
     *
     * @return mixed
     */
    public static function setValue(string $key, $value) {
        return \PerspectiveAPI\Connector::setSessionValue($key, $value);

    }//end getValue()

}//end class
