<?php
/**
 * DataRecord base class.
 *
 * @package    Perspective
 * @subpackage API
 * @author     Squiz Pty Ltd <products@squiz.net>
 * @copyright  2019 Squiz Pty Ltd (ABN 77 084 670 600)
 */

namespace PerspectiveAPI\Objects\Types;

use \PerspectiveAPI\Objects\AbstractObject as AbstractObject;
use \PerspectiveAPI\Objects\ReferenceTrait as ReferenceTrait;
use \PerspectiveAPI\Storage\Types\DataStore as DataStore;

/**
 * DataRecord Class.
 */
class DataRecord extends AbstractObject
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
        if (\PerspectiveAPI\Init::isValidID($id) === false) {
            throw new \PerspectiveAPI\Exception\InvalidDataException(
                sprintf(
                    _('Invalid Data record id (%s)'),
                    $id
                )
            );
        }

        $this->store       = $store;
        $this->id          = $id;
        $this->loadtime    = time();
        $this->remappingid = \PerspectiveAPI\Connector::getRemappingid(
            $this->getObjectType(),
            $this->store->getCode(),
            $this->id
        );

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
        $this->validateId();

        $parents = \PerspectiveAPI\Connector::getParents(
            $this->getObjectType(),
            $this->store->getCode(),
            $this->getID(),
            $depth
        );

        if ($this->validateId() === false) {
            $parents = \PerspectiveAPI\Connector::getParents(
                $this->getObjectType(),
                $this->store->getCode(),
                $this->getID(),
                $depth
            );
        }

        return $parents;

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
        $this->validateId();

        $children = \PerspectiveAPI\Connector::getChildren(
            $this->getObjectType(),
            $this->store->getCode(),
            $this->getID(),
            $depth
        );

        if ($this->validateId() === false) {
            $children = \PerspectiveAPI\Connector::getChildren(
                $this->getObjectType(),
                $this->store->getCode(),
                $this->getID(),
                $depth
            );
        }

        return $children;

    }//end getChildren()


    /**
     * Move data record.
     *
     * @param string $parentid The ID of the parent data record.
     *
     * @return void
     */
    public function moveDataRecord(string $parentid)
    {
        if (\PerspectiveAPI\Init::isValidID($parentid) === false) {
            throw new \PerspectiveAPI\Exception\InvalidDataException(
                sprintf(
                    _('Invalid Data record id (%s)'),
                    $parentid
                )
            );
        }

        \PerspectiveAPI\Connector::moveDataRecord($this->store->getCode(), $this->getID(), $parentid);

    }//end moveDataRecord()


}//end class
