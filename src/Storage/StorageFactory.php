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
        if (\PerspectiveAPI\Connector::getDataStoreExists($name) === true) {
            return new \PerspectiveAPI\Storage\Types\DataStore($name);
        }

        return null;

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
        if (\PerspectiveAPI\Connector::getUserStoreExists($name) === true) {
            return new \PerspectiveAPI\Storage\Types\UserStore($name);
        }

        return null;

    }//end getUserStore()


}//end class
