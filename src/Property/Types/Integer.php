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
class Integer extends Property
{


    /**
     * Increment integer.
     *
     * @param integer $value Amount to increment by.
     *
     * @return void
     */
    public function increment(int $value=1)
    {
        $this->setValue($this->getValue() + $value);

    }//end increment()


    /**
     * Decrement integer.
     *
     * @param integer $value Amount to decrement by.
     *
     * @return void
     */
    public function decrement(int $value=1)
    {
        $this->setValue($this->getValue() - $value);

    }//end decrement()


}//end class