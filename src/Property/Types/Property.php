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
    protected $code = null;

    /**
     * The object (page, user etc) or NULL for no object context.
     *
     * Important to stay private as this has been validated on instantiation.
     *
     * Also private so that we can throw an error when its used out of context.
     * E.g calling DataStore->property('integer')->increment() is out of context.
     * E.g calling DataStore->getDataRecord->property('integer')->increment() is in context.
     *
     * @var object
     * @see $this->getObject()
     * @see $this->getObjectid()
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
        // We need to validate the owner instances before calling validateConstructor.
        if ($owner instanceof \PerspectiveAPI\Storage\Types\UserStore
            || $owner instanceof \PerspectiveAPI\Storage\Types\DataStore
        ) {
            $this->object = null;
        } else if ($owner instanceof \PerspectiveAPI\Object\Types\User
            || $owner instanceof \PerspectiveAPI\Object\Types\DataRecord
            || $owner instanceof \PerspectiveAPI\Object\Types\ProjectInstance
        ) {
            $this->object = $owner;
        } else {
            throw new \Exception(_('Invalid owner object in property constructor'));
        }

        $this->code = $propertyCode;

    }//end __construct()


    /**
     * Gets the value of the property.
     *
     * @return mixed
     */
    public function getValue()
    {
        $store     = ($this->object->getStorage() ?? null);
        $storeCode = '';
        if ($store !== null) {
            $storeCode = $store->getCode();
        }

        return \PerspectiveAPI\Connector::getPropertyValue(
            $this->object->getObjectType(),
            $storeCode,
            $this->object->getID(),
            $this->code
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
        $store     = ($this->object->getStorage() ?? null);
        $storeCode = '';
        if ($store !== null) {
            $storeCode = $store->getCode();
        }

        \PerspectiveAPI\Connector::setPropertyValue(
            $this->object->getObjectType(),
            $storeCode,
            $this->object->getID(),
            $this->code,
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
        $store     = ($this->object->getStorage() ?? null);
        $storeCode = '';
        if ($store !== null) {
            $storeCode = $store->getCode();
        }

        \PerspectiveAPI\Connector::deletePropertyValue(
            $this->object->getObjectType(),
            $storeCode,
            $this->object->getID(),
            $this->code
        );

    }//end deleteValue()


}//end class
