<?php
/**
 * Object base class.
 *
 * @package    Perspective
 * @subpackage API
 * @author     Squiz Pty Ltd <products@squiz.net>
 * @copyright  2019 Squiz Pty Ltd (ABN 77 084 670 600)
 */

namespace PerspectiveAPI\Object;

use \PerspectiveAPI\Object\ObjectInterface as ObjectInterface;

/**
 * DataRecord Class.
 */
abstract class Object implements ObjectInterface
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
    abstract public function getID();


    /**
     * Gets the store that the record is contained within.
     *
     * @return object
     */
    abstract public function getStorage();


}//end class
