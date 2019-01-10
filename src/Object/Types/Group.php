<?php
/**
 * Group base class.
 *
 * @package    Perspective
 * @subpackage API
 * @author     Squiz Pty Ltd <products@squiz.net>
 * @copyright  2019 Squiz Pty Ltd (ABN 77 084 670 600)
 */

namespace PerspectiveAPI\Object\Types;

use \PerspectiveAPI\Object\Object as Object;
use \PerspectiveAPI\Object\ReferenceInterface as ReferenceInterface;
use \PerspectiveAPI\Storage\Types\UserStore as UserStore;

/**
 * Group Class.
 */
abstract class Group extends Object implements ReferenceInterface
{


    /**
     * Construct function for User Group.
     *
     * @param object $store The store the user group record belongs to.
     * @param string $id    The id of the user group.
     *
     * @return void
     */
    public function __construct(UserStore $store, string $id)
    {
        $this->store = $store;
        $this->id    = $id;

    }//end __construct()


    /**
     * Returns all user entityids in a specified group.
     *
     * @return array
     */
    abstract public function getMembers();

    /**
     * Get name.
     *
     * @return string
     */
    abstract public function getName();


    /**
     * Set name
     *
     * @param string $name The name of the group.
     *
     * @return void
     */
    abstract public function setName(string $name);


}//end class
