<?php
/**
 * ReferenceTrait
 *
 * These function signatures are shared across multiple base object type classes and should not diverge.
 *
 * @package    Perspective
 * @subpackage API
 * @author     Squiz Pty Ltd <products@squiz.net>
 * @copyright  2019 Squiz Pty Ltd (ABN 77 084 670 600)
 */

namespace PerspectiveAPI\Object;

/**
 * ReferenceTrait
 */
trait ReferenceTrait
{


    /**
     * Get reference.
     *
     * @param string $referenceCode The reference code.
     *
     * @return mixed
     */
    final public function getReference(string $referenceCode)
    {
        return \PerspectiveAPI\Connector::getReference($this->getObjectType(), $this->getID(), $referenceCode);

    }//end getReference()


    /**
     * Add reference.
     *
     * @param string $referenceCode The reference code.
     * @param mixed  $objects       Set of objects (User or DataRecord).
     *
     * @return void
     */
    final public function addReference(string $referenceCode, $objects)
    {
        return \PerspectiveAPI\Connector::addReference($this->getObjectType(), $this->getID(), $referenceCode, $objects);

    }//end addReference()


    /**
     * Set reference.
     *
     * @param string $referenceCode The reference code.
     * @param mixed  $objects       Set of objects (User or DataRecord).
     *
     * @return void
     */
    final public function setReference(string $referenceCode, $objects)
    {
        return \PerspectiveAPI\Connector::setReference($this->getObjectType(), $this->getID(), $referenceCode, $objects);

    }//end setReference()


    /**
     * Delete reference.
     *
     * @param string $referenceCode The reference code.
     * @param mixed  $objects       Set of objects (User or DataRecord).
     *
     * @return void
     */
    final public function deleteReference(string $referenceCode, $objects)
    {
        return \PerspectiveAPI\Connector::deleteReference($this->getObjectType(), $this->getID(), $referenceCode, $objects);

    }//end deleteReference()


}//end interface
