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
     * Current namespace
     *
     * @var string
     */
    private static function getPackage()
    {
        // Can't be statically cached as Authentication class can be called from different projects in a single process.
        $namespace = str_replace('\Framework\Authentication', '', static::class);
        $package   = strtolower(str_replace('\\', '/', $namespace));
        return $package;

    }//end getPackage()


    /**
     * Gets the current user object.
     *
     * @return object|null
     */
    final public static function getCurrentUser()
    {
        $user = null;
        if (self::$user !== null) {
            $user = self::$user;
        } else if (self::isLoggedIn() === true) {
            $user = self::$user;
        }

        if ($user !== null) {
            // The user could be from another project store, set the namespace to enable properties/references.
            $user->getStorage()->setPackage(self::getPackage());
        }

        return $user;

    }//end getCurrentUser()


    /**
     * Sets the current user object.
     *
     * @param object $user The user we want to set.
     *
     * @return void
     */
    final public static function setCurrentUser(\PerspectiveAPI\Objects\Types\User $user)
    {
        self::$user = $user;

    }//end setCurrentUser()


    /**
     * Gets current userid.
     *
     * @return string|null
     */
    final public static function getCurrentUserid()
    {
        $user = null;
        if (self::$user !== null) {
            $user = self::$user;
        } else if (self::isLoggedIn() === true) {
            $user = self::$user;
        }

        if ($user !== null) {
            return $user->getID();
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
    final public static function login(\PerspectiveAPI\Objects\Types\User $user)
    {
        if (\PerspectiveAPI\Connector::login($user->getID(), $user->getStorage()->getCode()) === true) {
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
                // TODO: @mhaidar need connector to return me the namespace.
                $package    = dirname($user['storeCode']);
                $namespace  = str_replace('/', '\\', $package);
                $className  = '\\'.$namespace.'\\Framework\StorageFactory';
                $userStore  = $className::getUserStore(basename($user['storeCode']));
                $typeClass  = ($user['typeClass'] ?? '\PerspectiveAPI\Objects\Types\User');
                self::$user = new $typeClass(
                    $userStore,
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


    /**
     * Gets the secret key.
     *
     * @return string
     */
    public static function getSecretKey()
    {
        return \PerspectiveAPI\Connector::getSecretKey();

    }//end getSecretKey()


}//end class
