<?php
/**
 * DataStore class.
 *
 * @package    Perspective
 * @subpackage API
 * @author     Squiz Pty Ltd <products@squiz.net>
 * @copyright  2019 Squiz Pty Ltd (ABN 77 084 670 600)
 */

namespace PerspectiveAPI\Storage\Types;

use \PerspectiveAPI\Storage\Types\Store as Store;

/**
 * DataStore Class.
 */
class DataStore extends Store
{


    /**
     * Create data record.
     *
     * @param string $type   The data record type code.
     * @param string $parent The ID of the parent data record.
     *
     * @return object
     */
    public function createDataRecord(string $type=null, string $parent=null)
    {
        if ($this->ownProjectContext() === false) {
            throw new \Exception('Operation out of own project context');
        }

        if ($type !== null) {
            $type      = $this->projectContext.'/'.$type;
            $typeClass = \PerspectiveAPI\Connector::getCustomTypeClassByName('data', $type);
            if ($typeClass === null) {
                throw new \Exception('Unknown custom data record type to create');
            }

            if (class_exists($typeClass) === false) {
                throw new \Exception('Type class can not be found');
            }
        } else {
            $typeClass = '\PerspectiveAPI\Objects\Types\DataRecord';
        }

        $id = \PerspectiveAPI\Connector::createDataRecord($this->code, $type, $parent);
        if ($id !== null) {
            return new $typeClass($this, $id);
        }

        throw new \Exception('Failed to create a new data record');

    }//end createDataRecord()


    /**
     * Gets the data record type object.
     *
     * @param string $id The ID of the data record.
     *
     * @return null|object
     */
    public function getDataRecord(string $id)
    {
        if (\PerspectiveAPI\Init::isValidID($id) === false) {
            throw new \PerspectiveAPI\Exception\InvalidDataException(
                sprintf(
                    _('Invalid Data record id (%s)'),
                    $id
                )
            );
        }

        $dataRecord = \PerspectiveAPI\Connector::getDataRecord($this->code, $id);
        if ($dataRecord === null) {
            return null;
        }

        if ($dataRecord['typeClass'] === null) {
            $dataRecord['typeClass'] = '\PerspectiveAPI\Objects\Types\DataRecord';
        }

        if (class_exists($dataRecord['typeClass']) === false) {
            throw new \Exception('Type class can not be found');
        }

        return new $dataRecord['typeClass']($this, $dataRecord['id']);

    }//end getDataRecord()


    /**
     * Return the data record type object that has the unique property value.
     *
     * @param string $propertyid The ID of the unique property.
     * @param string $value      The value of the unique property.
     *
     * @return null|object
     */
    public function getUniqueDataRecord(string $propertyid, string $value)
    {
        $dataRecord = $this->getStoreObjectByUniquePropertyValue('dataRecord', $propertyid, $value);
        return $dataRecord;

    }//end getUniqueDataRecord()


    /**
     * Given object info for a type it will return the object.
     *
     * @param string $baseType   Getting a dataRecord|user|group.
     * @param array  $objectInfo Object info applicable to instantiating that type.  In this case 'id'.
     *
     * @return object
     */
    protected function getStoreObjectFromObjectInfo(string $baseType, array $objectInfo)
    {
        return new $objectInfo['typeClass']($this, $objectInfo['id']);

    }//end getStoreObjectFromObjectInfo()


    /**
     * Cast data record.
     *
     * @param object $dataRecordObject   The data record object.
     * @param string $dataRecordTypeCode The data record type code.
     *
     * @return void
     */
    final public function castDataRecord(
        \PerspectiveAPI\Objects\Types\DataRecord &$dataRecordObject,
        string $dataRecordTypeCode
    ) {
        if ($dataRecordObject->getStorage() !== $this) {
            throw new \PerspectiveAPI\Exception\InvalidDataException(_('Data record object does not belong to this data store'));
        }

        $typeClass = \PerspectiveAPI\Connector::getCustomTypeClassByName(
            'data',
            $dataRecordObject->getProjectContext().'/'.$dataRecordTypeCode
        );

        if ($typeClass === null) {
            throw new \Exception('Unknown custom data record type to create');
        }

        if (class_exists($typeClass) === false) {
            throw new \Exception('Type class can not be found');
        }

        $dataRecordid = $dataRecordObject->getID();
        \PerspectiveAPI\Connector::setCustomType(
            $dataRecordObject->getObjectType(),
            $dataRecordObject->getStorageCode(),
            $dataRecordid,
            $dataRecordObject->getProjectContext().'/'.$dataRecordTypeCode
        );

        $dataRecordObject = new $typeClass($this, $dataRecordid);

    }//end castDataRecord()


}//end class
