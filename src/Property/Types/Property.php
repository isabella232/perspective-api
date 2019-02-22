<?php
/**
 * Property base class.
 *
 * Aim is to have the one class per property type regardless of the property system type.
 * There is functions like prepareWrite and isAspected to help with that.
 *
 * We can use abstract base class here as opposed to traits (like for object types) because these classes can not be
 * be extended in template php (custom types).
 *
 * @package    Perspective
 * @subpackage Template
 * @author     Squiz Pty Ltd <products@squiz.net>
 * @copyright  2014 Squiz Pty Ltd (ABN 77 084 670 600)
 */

namespace PerspectiveAPI\Property\Types;

/**
 * Property Class.
 */
abstract class Property
{

    /**
     * Code of the property object.
     *
     * @var string
     */
    protected $id = null;

    /**
     * The object owner (dataRecord, user etc)
     *
     * @var object
     */
    protected $object = null;


    /**
     * Class Constructor.
     *
     * @param object $owner        The owner object (storage type or object type).
     * @param string $propertyCode The property code.
     *
     * @return void
     * @throws \Exception When invalid owner.
     */
    public function __construct($owner, string $propertyCode)
    {
        if ($owner instanceof \PerspectiveAPI\Objects\Types\User
            || $owner instanceof \PerspectiveAPI\Objects\Types\DataRecord
            || $owner instanceof \PerspectiveAPI\Objects\Types\ProjectInstance
        ) {
            $this->object = $owner;
        } else {
            throw new \Exception(_('Invalid owner object in property constructor'));
        }

        $this->id = $propertyCode;

    }//end __construct()


    /**
     * Gets the value of the property.
     *
     * @return mixed
     */
    public function getValue()
    {
        $store = $this->object->getStorage();

        return \PerspectiveAPI\Connector::getPropertyValue(
            $this->object->getObjectType(),
            $store->getCode(),
            $this->object->getID(),
            $store->getProjectContext().'/'.$this->id
        );

    }//end getValue()


    /**
     * Sets the value of the property.
     *
     * @param mixed $value The value to set into the property.
     *
     * @return void
     * @throws InvalidDataException When propertyid is not known.
     * @throws ReadOnlyException    When request is in read only mode.
     */
    public function setValue($value)
    {
        $store = $this->object->getStorage();
        \PerspectiveAPI\Connector::setPropertyValue(
            $this->object->getObjectType(),
            $store->getCode(),
            $this->object->getID(),
            $store->getProjectContext().'/'.$this->id,
            $value
        );

    }//end setValue()


    /**
     * Deletes the set value of the property.
     *
     * @return void
     * @throws InvalidDataException Thrown when propertyid is unknown.
     * @throws ReadOnlyException    When request is in read only mode.
     */
    public function deleteValue()
    {
        $store = $this->object->getStorage();

        \PerspectiveAPI\Connector::deletePropertyValue(
            $this->object->getObjectType(),
            $store->getCode(),
            $this->object->getID(),
            $store->getProjectContext().'/'.$this->id
        );

    }//end deleteValue()


}//end class
