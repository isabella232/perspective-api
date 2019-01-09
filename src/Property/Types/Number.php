<?php
/**
 * Number property base class.
 *
 * @package    Perspective
 * @subpackage API
 * @author     Squiz Pty Ltd <products@squiz.net>
 * @copyright  2019 Squiz Pty Ltd (ABN 77 084 670 600)
 */

namespace PerspectiveAPI\Property\Types;

use \PerspectiveAPI\Property\Types\Property as Property;

/**
 * Number Class.
 */
abstract class Number extends Property
{


    /**
     * Increment number.
     *
     * @param float $value Amount to increment by.
     *
     * @return void
     */
    abstract public function increment(float $value=1);


    /**
     * Decrement number.
     *
     * @param float $value Amount to decrement by.
     *
     * @return void
     */
    abstract public function decrement(float $value=1);


}//end class