<?php
/**
 * Cache base class.
 *
 * @package    Perspective
 * @subpackage API
 * @author     Squiz Pty Ltd <products@squiz.net>
 * @copyright  2019 Squiz Pty Ltd (ABN 77 084 670 600)
 */

namespace PerspectiveAPI;

/**
 * Cache class.
 */
class Cache
{

    /**
     * Flag representing if we have been asked not to cache.
     *
     * @var integer
     */
    private static $noCache = false;


    /**
     * Flags this should not be cached.
     *
     * @return void
     */
    public static function noCache()
    {
        self::$noCache = true;

    }//end noCache()


}//end class
