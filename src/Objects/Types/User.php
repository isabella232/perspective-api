<?php
/**
 * User base class.
 *
 * @package    Perspective
 * @subpackage API
 * @author     Squiz Pty Ltd <products@squiz.net>
 * @copyright  2019 Squiz Pty Ltd (ABN 77 084 670 600)
 */

namespace PerspectiveAPI\Objects\Types;

use \PerspectiveAPI\Objects\AbstractObject as AbstractObject;
use \PerspectiveAPI\Objects\ReferenceTrait as ReferenceTrait;
use \PerspectiveAPI\Storage\Types\UserStore as UserStore;

/**
 * User Class.
 */
class User extends AbstractObject
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
        \PerspectiveAPI\Connector::setUsername($this->getID(), $this->store->getCode(), $username);
        $this->username = $username;

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
        \PerspectiveAPI\Connector::setUserFirstName($this->getID(), $this->store->getCode(), $firstName);
        $this->firstName = $firstName;

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
        \PerspectiveAPI\Connector::setUserLastName($this->getID(), $this->store->getCode(), $lastName);
        $this->lastName = $lastName;

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
        \PerspectiveAPI\Connector::addUserToGroup($this->getID(), $this->store->getCode(), $groupid);

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
        \PerspectiveAPI\Connector::removeUserFromGroup($this->getID(), $this->store->getCode(), $groupid);

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
