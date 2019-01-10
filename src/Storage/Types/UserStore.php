<?php
/**
 * UserStore class.
 *
 * @package    Perspective
 * @subpackage API
 * @author     Squiz Pty Ltd <products@squiz.net>
 * @copyright  2019 Squiz Pty Ltd (ABN 77 084 670 600)
 */

namespace PerspectiveAPI\Storage\Types;

use \PerspectiveAPI\Storage\Types\Store as Store;

/**
 * UserStore Class.
 */
abstract class UserStore extends Store
{


    /**
     * Creates an user and assign it to user groups. Returns created user entityid.
     *
     * @param string $username  The username of user.
     * @param string $firstName User first name.
     * @param string $lastName  User last name.
     * @param string $type      User type code.
     *                          TODO: this is a palceholder until user types are implemented.
     * @param array  $groups    Optional. Parent user groups to assign the new user to. If left empty, user will be
     *                          created under root user group.
     *
     * @return object
     */
    abstract public function createUser(
        string $username,
        string $firstName,
        string $lastName,
        string $type=null,
        array $groups=[]
    );


    /**
     * Gets the user group object.
     *
     * @param string $id The ID of the group.
     *
     * @return null|object
     */
    abstract public function getGroup(string $id);


    /**
     * Gets the user type object by username.
     *
     * @param string $username The username of user.
     *
     * @return null|object
     * @throws InvalidDataException When username is empty.
     */
    abstract public function getUserByUsername(string $username);


}//end class
