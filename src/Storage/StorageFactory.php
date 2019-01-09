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
abstract class StorageFactory
{


    /**
     * Gets the data store object.
     *
     * @param string $name The data store name.
     *
     * @return null|object
     */
    abstract public static function getDataStore(string $name);


    /**
     * Gets the user store object.
     *
     * @param string $name The user store name.
     *
     * @return null|object
     */
    abstract public static function getUserStore(string $name);


}//end class
