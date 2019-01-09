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

/**
 * Group Class.
 */
abstract class Group extends Object implements ReferenceInterface
{


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
