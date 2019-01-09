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
interface AuthenticationInterface
{

    /**
     * Gets the current user object.
     *
     * @return object|null
     */
    public static function getCurrentUser();


    /**
     * Gets current userid.
     *
     * @return string|null
     */
    public static function getCurrentUserid();


    /**
     * Login.
     *
     * @param object $user The user we want to login.
     *
     * @return void
     */
    public static function login(\PerspectiveAPI\Object\Types\User $user);


    /**
     * Logout
     *
     * @return boolean
     */
    public static function logout();


    /**
     * Checks if the user is logged in.
     *
     * @return boolean
     */
    public static function isLoggedIn();


}//end interface
