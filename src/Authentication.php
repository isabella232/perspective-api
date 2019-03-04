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
    private static function getProjectContext()
    {
        // Can't be statically cached as Authentication class can be called from different projects in a single process.
        $namespace      = str_replace('\Framework\Authentication', '', static::class);
        $projectContext = strtolower(\PerspectiveAPI\Connector::getProjectContext($namespace));
        return $projectContext;

    }//end getProjectContext()


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
            $context = self::getProjectContext();
            if ($user->getStorage()->getProjectContext() !== $context) {
                $user->getStorage()->setProjectContext($context);
                // TODO: @mhaidar alternative way to avoid needing a setProjectContext function. Not sure how user
                // remapping functionality will fit in later.
                /*$userStore  = new \PerspectiveAPI\Storage\Types\UserStore(
                    $user->getStorage()->getCode(),
                    $context
                );
                $typeClass  = '\\'.get_class($user);
                self::$user = new $typeClass(
                    $userStore,
                    $user->getId(),
                    $user->getUsername(),
                    $user->getFirstName(),
                    $user->getLastName()
                );

                return self::$user;*/
            }
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
                $userStore  = new \PerspectiveAPI\Storage\Types\UserStore($user['storeCode']);
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
