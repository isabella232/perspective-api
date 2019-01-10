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
use \PerspectiveAPI\Object\ReferenceInterface as ReferenceInterface;
use \PerspectiveAPI\Storage\Types\DataStore as DataStore;

/**
 * DataRecord Class.
 */
abstract class DataRecord extends AspectedObject implements ReferenceInterface
{


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
    abstract public function getParents(int $depth=null);


    /**
     * Returns a flat list of data record's children including their dataRecordid and level.
     *
     * @param integer $depth The max depth.
     *
     * @return array
     */
    abstract public function getChildren(int $depth=null);


}//end class
