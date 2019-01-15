<?php
/**
 * StorageFactory class.
 *
 * @package    Perspective
 * @subpackage API
 * @author     Squiz Pty Ltd <products@squiz.net>
 * @copyright  2019 Squiz Pty Ltd (ABN 77 084 670 600)
 */

namespace PerspectiveAPI\Storage;

/**
 * StorageFactory Class.
 */
class StorageFactory
{


    /**
     * Gets the data store object.
     *
     * @param string $name The data store name.
     *
     * @return null|object
     */
    public static function getDataStore(string $name)
    {
        return \PerspectiveAPI\Connector::getDataStore($name);

    }//end getDataStore()


    /**
     * Gets the user store object.
     *
     * @param string $name The user store name.
     *
     * @return null|object
     */
    public static function getUserStore(string $name)
    {
        return \PerspectiveAPI\Connector::getUserStore($name);

    }//end getUserStore()


}//end class
