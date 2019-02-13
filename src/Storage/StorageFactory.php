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
     * Data/User store objects.
     *
     * @var array
     */
    private static $stores = [
        'data' => [],
        'user' => [],
    ];


    /**
     * Private constructor to stay static.
     *
     * @return void
     */
    private function __construct()
    {

    }//end __construct()


    /**
     * Gets the data store object.
     *
     * @param string $name The data store name.
     *
     * @return null|object
     */
    public static function getDataStore(string $name)
    {
        $projectCode = str_replace('\Framework\StorageFactory', '', static::class);
        $name        = str_replace('\\', '/', $projectCode).'/'.$name;

        if (isset(self::$stores['data'][$name]) === true) {
            return self::$stores['data'][$name];
        }

        if (\PerspectiveAPI\Connector::getDataStoreExists($name) === true) {
            self::$stores['data'][$name] = new \PerspectiveAPI\Storage\Types\DataStore($name);
            return self::$stores['data'][$name];
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
        $projectCode = str_replace('\Framework\StorageFactory', '', static::class);
        $name        = str_replace('\\', '/', $projectCode).'/'.$name;

        if (isset(self::$stores['user'][$name]) === true) {
            return self::$stores['user'][$name];
        }

        if (\PerspectiveAPI\Connector::getUserStoreExists($name) === true) {
            self::$stores['user'][$name] = new \PerspectiveAPI\Storage\Types\UserStore($name);
            return self::$stores['user'][$name];
        }

        return null;

    }//end getUserStore()


}//end class
