<?php
/**
 * ObjectInterface
 *
 * These function signatures are shared across multiple base object type classes and should not diverge.
 *
 * @package    Perspective
 * @subpackage API
 * @author     Squiz Pty Ltd <products@squiz.net>
 * @copyright  2019 Squiz Pty Ltd (ABN 77 084 670 600)
 */

namespace PerspectiveAPI\Object;

/**
 * ObjectInterface
 */
interface ObjectInterface
{


    /**
     * Gets the value of a given property.
     *
     * @param string $propertyCode The code of the property that is being retrieved.
     *
     * @return mixed
     */
    public function getValue(string $propertyCode);


    /**
     * Sets the value of a given property.
     *
     * @param string $propertyCode The code of the property that the value is being set into.
     * @param mixed  $value        The value to set into the property.
     *
     * @return void
     */
    public function setValue(string $propertyCode, $value);


    /**
     * Deletes the value of a given property.
     *
     * @param string $propertyCode The code of the property that the value is being deleted from.
     *
     * @return void
     */
    public function deleteValue(string $propertyCode);


    /**
     * Get the property type object.
     *
     * @param string $propertyCode The property code.
     *
     * @return object
     */
    public function property(string $propertyCode);


}//end interface
