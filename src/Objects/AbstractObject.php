<?php
/**
 * AbstractObject base class.
 *
 * @package    Perspective
 * @subpackage API
 * @author     Squiz Pty Ltd <products@squiz.net>
 * @copyright  2019 Squiz Pty Ltd (ABN 77 084 670 600)
 */

namespace PerspectiveAPI\Objects;

/**
 * DataRecord Class.
 */
abstract class AbstractObject
{


    /**
     * ID of the data record object.
     *
     * @var string
     */
    protected $id = null;

    /**
     * The data store object.
     *
     * @var object
     */
    protected $store = null;


    /**
     * Gets the internal ID of the data record.
     *
     * @return string
     */
    final public function getID()
    {
        return $this->id;

    }//end getID()


    /**
     * Gets the store that the record is contained within.
     *
     * @return object
     */
    final public function getStorage()
    {
        return $this->store;

    }//end getStorage()


    /**
     * Gets the value of a given property.
     *
     * @param string $propertyCode The code of the property that is being retrieved.
     *
     * @return mixed
     */
    final public function getValue(string $propertyCode)
    {
        $property = $this->property($propertyCode);
        if ($property === null) {
            return null;
        }

        return $property->getValue();

    }//end getValue()


    /**
     * Sets the value of a given property.
     *
     * @param string $propertyCode The code of the property that the value is being set into.
     * @param mixed  $value        The value to set into the property.
     *
     * @return void
     */
    final public function setValue(string $propertyCode, $value)
    {
        $property = $this->property($propertyCode);
        if ($property === null) {
            return null;
        }

        return $property->setValue($value);

    }//end setValue()


    /**
     * Deletes the value of a given property.
     *
     * @param string $propertyCode The code of the property that the value is being deleted from.
     *
     * @return void
     */
    final public function deleteValue(string $propertyCode)
    {
        $property = $this->property($propertyCode);
        if ($property === null) {
            return null;
        }

        return $property->deleteValue();

    }//end deleteValue()


    /**
     * Get the property type object.
     *
     * @param string $propertyCode The property code.
     *
     * @return object
     */
    final public function property(string $propertyCode)
    {
        $propertyTypeClass = \PerspectiveAPI\Connector::getPropertyTypeClass($this->getObjectType(), $propertyCode);
        if ($propertyTypeClass === null) {
            throw new \Exception('Unknown property code');
        }

        return new $propertyTypeClass($this, $propertyCode);

    }//end property()


    /**
     * Gets the type of the object.
     *
     * @return string
     */
    final public function getObjectType()
    {
        if ($this instanceof \PerspectiveAPI\Objects\Types\DataRecord) {
            $objectType = 'data';
        } else if ($this instanceof \PerspectiveAPI\Objects\Types\User
            || $this instanceof \PerspectiveAPI\Objects\Types\Group
        ) {
            $objectType = 'user';
        } else if ($this instanceof \PerspectiveAPI\Objects\Types\ProjectInstance) {
            $objectType = 'project';
        }

        return $objectType;

    }//end getObjectType()


}//end class
