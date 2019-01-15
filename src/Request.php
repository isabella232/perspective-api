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
        return new \PerspectiveAPI\Connector::getProject();

    }//end getProjectInstance()


}//end class
