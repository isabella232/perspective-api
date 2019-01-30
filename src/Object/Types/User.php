<?php
/**
 * User base class.
 *
 * @package    Perspective
 * @subpackage API
 * @author     Squiz Pty Ltd <products@squiz.net>
 * @copyright  2019 Squiz Pty Ltd (ABN 77 084 670 600)
 */

namespace PerspectiveAPI\Object\Types;

use \PerspectiveAPI\Object\Object as Object;
use \PerspectiveAPI\Object\ReferenceTrait as ReferenceTrait;
use \PerspectiveAPI\Storage\Types\UserStore as UserStore;

/**
 * User Class.
 */
class User extends Object
{

    use ReferenceTrait;

    /**
     * The username of the user
     *
     * @var string|null
     */
    private $username = null;


    /**
     * Construct function for User.
     *
     * @param object $store     The store the user record belongs to.
     * @param string $id        The id of the user.
     * @param string $username  The user name of the user.
     * @param string $firstName The users first name.
     * @param string $lastName  The users last name.
     *
     * @return void
     */
    public function __construct(
        UserStore $store,
        string $id,
        string $username=null,
        string $firstName=null,
        string $lastName=null
    ) {
        $this->store = $store;
        $this->id    = $id;

        if ($username !== null) {
            $this->username = $username;
        }

        if ($firstName !== null) {
            $this->firstName = $firstName;
        }

        if ($lastName !== null) {
            $this->lastName = $lastName;
        }

    }//end __construct()


    /**
     * Get username.
     *
     * @return string
     */
    final public function getUsername()
    {
        return $this->username;

    }//end getUsername()


    /**
     * Get first name.
     *
     * @return string
     */
    final public function getFirstName()
    {
        return $this->firstName;

    }//end getFirstName()


    /**
     * Get last name.
     *
     * @return string
     */
    final public function getLastName()
    {
        return $this->lastName;

    }//end getLastName()


    /**
     * Set username.
     *
     * @param string $username The username.
     *
     * @return void
     */
    final public function setUsername(string $username)
    {
        if (\PerspectiveAPI\Connector::setUsername($this->getID(), $this->store->getCode(), $username) === true) {
            $this->username = $username;
        } else {
            throw new \Exception('Failed to set username');
        }

    }//end setFirstName()


    /**
     * Set first name
     *
     * @param string $firstName The first name of the user.
     *
     * @return void
     */
    final public function setFirstName(string $firstName)
    {
        if (\PerspectiveAPI\Connector::setUserFirstName($this->getID(), $this->store->getCode(), $firstName) === true) {
            $this->firstName = $firstName;
        } else {
            throw new \Exception('Failed to set user\'s first name');
        }

    }//end setFirstName()


    /**
     * Set last name
     *
     * @param string $lastName The last name of the user.
     *
     * @return void
     */
    final public function setLastName(string $lastName)
    {
        if (\PerspectiveAPI\Connector::setUserLastName($this->getID(), $this->store->getCode(), $lastName) === true) {
            $this->lastName = $lastName;
        } else {
            throw new \Exception('Failed to set user\'s last name');
        }

    }//end setLastName()


    /**
     * Assign an user to parent groups.
     *
     * @param mixed $groupid Parent user groups to assign the user to.
     *
     * @return void
     */
    final public function addToGroup(string $groupid)
    {
        if (\PerspectiveAPI\Connector::addUserToGroup($this->getID(), $this->store->getCode(), $groupid) === false) {
            throw new \Exception('Failed to add user to group');
        }

    }//end addToGroup()


    /**
     * Remove an user from specified parent groups.
     *
     * @param mixed $groupid Parent user groups to remove the user from.
     *
     * @return void
     */
    final public function removeFromGroup(string $groupid)
    {
        if (\PerspectiveAPI\Connector::removeUserFromGroup($this->getID(), $this->store->getCode(), $groupid) === false) {
            throw new \Exception('Failed to remove user from group');
        }

    }//end removeFromGroup()


    /**
     * Returns all parent group entityids for a specified user.
     *
     * @return array
     */
    final public function getGroups()
    {
        return \PerspectiveAPI\Connector::getUserGroups($this->getID(), $this->store->getCode());

    }//end getGroups()


}//end class
