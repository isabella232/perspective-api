<?php
/**
 * Authentication base class.
 *
 * @package    Perspective
 * @subpackage API
 * @author     Squiz Pty Ltd <products@squiz.net>
 * @copyright  2019 Squiz Pty Ltd (ABN 77 084 670 600)
 */

namespace PerspectiveAPI;

/**
 * Authentication Interface.
 */
class Authentication
{

    /**
     * The current user.
     *
     * @var object
     */
    private static $user = null;

    /**
     * Logged in flag.
     *
     * @var boolean
     */
    private static $loggedIn = null;


    /**
     * Gets the current user object.
     *
     * @return object|null
     */
    final public static function getCurrentUser()
    {
        if (self::isLoggedIn() === true) {
            return self::$user;
        }

        return null;

    }//end getCurrentUser()


    /**
     * Gets current userid.
     *
     * @return string|null
     */
    final public static function getCurrentUserid()
    {
        if (self::isLoggedIn() === true) {
            return self::$user->getID();
        }

        return null;

    }//end getCurrentUserid()


    /**
     * Login.
     *
     * @param object $user The user we want to login.
     *
     * @return void
     */
    final public static function login(\PerspectiveAPI\Object\Types\User $user)
    {
        if (\PerspectiveAPI\Connector::login($user->getID()) === true) {
            self::$user     = $user;
            self::$loggedIn = true;
        } else {
            throw new \Exception('Failed to login');
        }

    }//end login()


    /**
     * Logout
     *
     * @return boolean
     */
    final public static function logout()
    {
        if (\PerspectiveAPI\Connector::logout() === true) {
            self::$user     = null;
            self::$loggedIn = false;
        } else {
            throw new \Exception('Failed to log out');
        }

    }//end logout()


    /**
     * Checks if the user is logged in.
     *
     * @return boolean
     */
    final public static function isLoggedIn()
    {
        if (self::$loggedIn === null) {
            $user = \PerspectiveAPI\Connector::getLoggedInUser();
            if ($user === null) {
                self::$loggedIn = false;
            } else {
                self::$user     = new \PerspectiveAPI\Object\Types\User(
                    \PerspectiveAPI\StorageFactory::getUserStore($user['storeCode']),
                    $user['id'],
                    $user['username'],
                    $user['firstName'],
                    $user['lastName']
                );
                self::$loggedIn = true;
            }
        }

        return self::$loggedIn;

    }//end isLoggedIn()


}//end class
