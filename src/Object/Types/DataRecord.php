<?php
/**
 * DataRecord base class.
 *
 * @package    Perspective
 * @subpackage API
 * @author     Squiz Pty Ltd <products@squiz.net>
 * @copyright  2019 Squiz Pty Ltd (ABN 77 084 670 600)
 */

namespace PerspectiveAPI\Object\Types;

use \PerspectiveAPI\Object\AspectedObject as AspectedObject;
use \PerspectiveAPI\Object\ReferenceTrait as ReferenceTrait;
use \PerspectiveAPI\Storage\Types\DataStore as DataStore;

/**
 * DataRecord Class.
 */
class DataRecord extends AspectedObject
{

    use ReferenceTrait;

    /**
     * Construct function for Data Record.
     *
     * @param object $store The store the data record belongs to.
     * @param string $id    The id of the data record.
     *
     * @return void
     */
    public function __construct(DataStore $store, string $id)
    {
        $this->store = $store;
        $this->id    = $id;

    }//end __construct()


    /**
     * Returns a flat list of data record's parents.
     *
     * @param integer $depth The max depth.
     *
     * @return array
     */
    public function getParents(int $depth=null)
    {
        return \PerspectiveAPI\Connector::getParents($this->getObjectType(), $this->getID(), $depth);

    }//end getParents()


    /**
     * Returns a flat list of data record's children including their dataRecordid and level.
     *
     * @param integer $depth The max depth.
     *
     * @return array
     */
    public function getChildren(int $depth=null)
    {
        return \PerspectiveAPI\Connector::getChildren($this->getObjectType(), $this->getID(), $depth);

    }//end getChildren()


}//end class
