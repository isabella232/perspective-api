<?php
/**
 * Integer property base class.
 *
 * @package    Perspective
 * @subpackage API
 * @author     Squiz Pty Ltd <products@squiz.net>
 * @copyright  2019 Squiz Pty Ltd (ABN 77 084 670 600)
 */

namespace PerspectiveAPI\Property\Types;

use \PerspectiveAPI\Property\Types\Property as Property;

/**
 * Integer Class.
 */
abstract class Integer extends Property
{


    /**
     * Increment integer.
     *
     * @param integer $value Amount to increment by.
     *
     * @return void
     */
    abstract public function increment(int $value=1);


    /**
     * Decrement integer.
     *
     * @param integer $value Amount to decrement by.
     *
     * @return void
     */
    abstract public function decrement(int $value=1);


}//end class