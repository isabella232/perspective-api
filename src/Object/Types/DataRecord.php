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

/**
 * DataRecord Class.
 */
abstract class DataRecord extends AspectedObject implements ReferenceInterface
{


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
