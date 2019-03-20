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
     * The object load time.
     *
     * @var int
     */
    protected $loadtime = null;

    /**
     * Flag the object is being remapped to another id.
     *
     * @var string
     */
    protected $remapid = null;

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
     * Gets the storeage code that the record is contained within.
     *
     * @return object
     */
    final public function getStorageCode()
    {
        if ($this instanceof \PerspectiveAPI\Objects\Types\ProjectInstance) {
            return '';
        } else {
            return $this->store->getCode();
        }

    }//end getStorageCode()


    /**
     * Gets the project context.
     *
     * @return string
     */
    final public function getProjectContext()
    {
        if ($this instanceof \PerspectiveAPI\Objects\Types\ProjectInstance) {
            return $this->projectContext;
        } else {
            return $this->store->getProjectContext();
        }

    }//end getProjectContext()


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
        $validProperty     = \PerspectiveAPI\Init::validatePropertyid($propertyCode);
        $propertyType      = substr(strrchr($propertyCode, '.'), 1);
        $propertyTypeClass = '\PerspectiveAPI\Property\Types\\'.ucfirst($propertyType);
        if (class_exists($propertyTypeClass) === false) {
            throw new \PerspectiveAPI\Exception\InvalidDataException(sprintf('Unknown property type %s', $propertyType));
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


    /**
     * Validate the object id.
     *
     * Call BEFORE using $this->id in a READ operation.
     * Call BEFORE and AFTER a READ operation. Repeat READ operation if invalid.
     *
     * No need to use in a WRITE operation as it acquires locks to the object.
     * No need to use for Page objects as there is no WRITE operations in the API.
     *
     * Returns FALSE if the object id has changed during the current process.
     * It will update $this->id to the new object id so that the next READ request occurs on the correct id.
     *
     * Do not document as part of API.
     * Didn't want to make this public was but forced to for the property objects to call.
     *
     * @return boolean
     */
    final public function validateId()
    {
        $objectType  = $this->getObjectType();
        $storageCode = $this->getStorageCode();
        if ($objectType === 'project') {
            // Project instance excempt because the object id is the instanceid which is fixed.
            return true;
        }

        // On load time, we didn't find that we are remapping and it has been less than 5 seconds, we can return
        // because the background remapping process waits 5 seconds before it starts.
        $wait = 5; // TODO: needs a constant.
        $time = (time() - $this->loadtime);
        if ($this->remapid === null && ($time < $wait)) {
            return true;
        }

        if ($this->remapid !== null) {
            // On load time, we found that we are remapping we need to check if it has finished.
            $remapid = \PerspectiveAPI\Connector::getPendingRemapid($objectType, $storageCode, $this->id);
            if ($remapid !== null) {
                // Still remapping. Note here $remapid === $this->remapid, impossible otherwise.
                return true;
            } else {
                // Must of finished.
                if ($time > $wait) {
                    // Its been longer than 5 seconds since we last checked, anything could have happened.
                    // Possible for a second chained remap to have started and finished.
                    $this->id = \PerspectiveAPI\Connector::getRemapid($objectType, $storageCode, $this->remapid);
                } else {
                    $this->id = $this->remapid;
                }

                $this->remapid  = \PerspectiveAPI\Connector::getPendingRemapid($objectType, $storageCode, $this->id);
                $this->loadtime = time();

                return false;
            }
        } else if ($time > $wait) {
            // Its not remapping and its been longer than 5 seconds since we last checked, anything could have happened
            // especially in a really long running process. Start over, check both DB and Redis.
            $objectid = \PerspectiveAPI\Connector::getRemapid($objectType, $storageCode, $this->id, true);
            if ($objectid === null) {
                $this->remapid  = \PerspectiveAPI\Connector::getPendingRemapid($objectType, $storageCode, $this->id);
                $this->loadtime = time();

                return true;
            } else {
                $this->id       = $objectid;
                $this->remapid  = \PerspectiveAPI\Connector::getPendingRemapid($objectType, $storageCode, $this->id);
                $this->loadtime = time();

                return false;
            }
        }//end if

        return true;

    }//end validateId()

}//end class
