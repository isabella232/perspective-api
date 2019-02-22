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

namespace PerspectiveAPI\Objects;

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
        $referenceCode = $this->store->getPackage().'/'.$referenceCode;
        $results       = \PerspectiveAPI\Connector::getReference(
            $this->getObjectType(),
            $this->getID(),
            $this->store->getCode(),
            $referenceCode
        );

        if ($results === null) {
            return null;
        }

        $references = [];
        $multiple   = isset($results[0]);
        if ($multiple === false) {
            $results = [$results];
        }

        foreach ($results as $result) {
            if ($result['objectType'] === 'user') {
                $userStore    = new \PerspectiveAPI\Storage\Types\UserStore(
                    dirname($result['storeCode']),
                    basename($result['storeCode'])
                );
                $typeClass    = ($result['typeClass'] ?? '\PerspectiveAPI\Objects\Types\User');
                $references[] = new $typeClass(
                    $userStore,
                    $result['id'],
                    $result['username'],
                    $result['firstName'],
                    $result['lastName']
                );

                $userStore->setPackage($this->store->getPackage());
            } else {
                $dataStore    = new \PerspectiveAPI\Storage\Types\DataStore(
                    dirname($result['storeCode']),
                    basename($result['storeCode'])
                );
                $typeClass    = ($result['typeClass'] ?? '\PerspectiveAPI\Objects\Types\DataRecord');
                $references[] = new $typeClass(
                    $dataStore,
                    $result['id']
                );

                $dataStore->setPackage($this->store->getPackage());
            }
        }

        if ($multiple === false) {
            $references = $references[0];
        }

        return $references;

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
        $referenceCode = $this->store->getPackage().'/'.$referenceCode;
        return \PerspectiveAPI\Connector::addReference($this->getObjectType(), $this->getID(), $this->store->getCode(), $referenceCode, $objects);

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
        $referenceCode = $this->store->getPackage().'/'.$referenceCode;
        return \PerspectiveAPI\Connector::setReference($this->getObjectType(), $this->getID(), $this->store->getCode(), $referenceCode, $objects);

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
        $referenceCode = $this->store->getPackage().'/'.$referenceCode;
        return \PerspectiveAPI\Connector::deleteReference($this->getObjectType(), $this->getID(), $this->store->getCode(), $referenceCode, $objects);

    }//end deleteReference()


}//end interface
