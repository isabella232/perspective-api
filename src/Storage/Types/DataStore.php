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
        return \PerspectiveAPI\Connector::createDataRecord($this->code, $type, $parent);

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
        return \PerspectiveAPI\Connector::getDataRecord($this->code, $id);

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
        return \PerspectiveAPI\Connector::getDataRecordByValue($this->code, $propertyid, $value);

    }//end getUniqueDataRecord()


}//end class
