<?php
/**
 * Request base class.
 *
 * @package    Perspective
 * @subpackage API
 * @author     Squiz Pty Ltd <products@squiz.net>
 * @copyright  2019 Squiz Pty Ltd (ABN 77 084 670 600)
 */

namespace PerspectiveAPI;

/**
 * Request class.
 */
class Request
{

    /**
     * Returns the current deployment object.
     *
     * @return object
     */
    public static function getProjectInstance()
    {
        return new \PerspectiveAPI\Object\Types\ProjectInstance(
            \PerspectiveAPI\Connector::getProjectInstanceID()
        );

    }//end getProjectInstance()


    /**
     * Flag for is simulator.
     *
     * @return boolean
     */
    public static function isSimulated()
    {
        return \PerspectiveAPI\Connector::isSimulated();

    }//end isSimulated()


    /**
     * Returns true if the request is in a read-only mode.
     *
     * @return boolean
     */
    public static function isReadOnly()
    {
        return \PerspectiveAPI\Connector::isReadOnly();

    }//end isReadOnly()


    /**
     * Suppresses 404 response code
     *
     * @return void
     */
    public static function suppress404()
    {
        \PerspectiveAPI\Connector::suppress404();

    }//end suppress404()


}//end class
