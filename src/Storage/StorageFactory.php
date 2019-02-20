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
     * @param string $storeid The data storeid.
     *
     * @return null|object
     */
    public static function getDataStore(string $storeid)
    {
        $namespace = str_replace('\Framework\StorageFactory', '', static::class);
        $package   = strtolower(str_replace('\\', '/', $namespace));
        $storeCode = $package.'/'.$storeid;

        if (isset(self::$stores['data'][$storeCode]) === true) {
            return self::$stores['data'][$storeCode];
        }

        if (\PerspectiveAPI\Connector::getDataStoreExists($storeCode) === true) {
            self::$stores['data'][$storeCode] = new \PerspectiveAPI\Storage\Types\DataStore($package, $storeid);
            return self::$stores['data'][$storeCode];
        }

        return null;

    }//end getDataStore()


    /**
     * Gets the user store object.
     *
     * @param string $storeid The user storeid.
     *
     * @return null|object
     */
    public static function getUserStore(string $storeid)
    {
        $namespace = str_replace('\Framework\StorageFactory', '', static::class);
        $package   = strtolower(str_replace('\\', '/', $namespace));
        $storeCode = $package.'/'.$storeid;

        if (isset(self::$stores['user'][$storeCode]) === true) {
            return self::$stores['user'][$storeCode];
        }

        if (\PerspectiveAPI\Connector::getUserStoreExists($storeCode) === true) {
            self::$stores['user'][$storeCode] = new \PerspectiveAPI\Storage\Types\UserStore($package, $storeid);
            return self::$stores['user'][$storeCode];
        }

        return null;

    }//end getUserStore()


}//end class
