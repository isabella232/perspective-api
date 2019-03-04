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
        $referenceCode = $this->getProjectContext().'/'.$referenceCode;
        $results       = \PerspectiveAPI\Connector::getReference(
            $this->getObjectType(),
            $this->getID(),
            $this->getStorageCode(),
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
                    $result['storeCode'],
                    $this->getProjectContext()
                );
                $typeClass    = ($result['typeClass'] ?? '\PerspectiveAPI\Objects\Types\User');
                $references[] = new $typeClass(
                    $userStore,
                    $result['id'],
                    $result['username'],
                    $result['firstName'],
                    $result['lastName']
                );
            } else {
                $dataStore    = new \PerspectiveAPI\Storage\Types\DataStore(
                    $result['storeCode'],
                    $this->getProjectContext()
                );
                $typeClass    = ($result['typeClass'] ?? '\PerspectiveAPI\Objects\Types\DataRecord');
                $references[] = new $typeClass(
                    $dataStore,
                    $result['id']
                );
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
        $referenceCode = $this->getProjectContext().'/'.$referenceCode;
        $objects       = self::getReferencedObjectsArray($objects);
        return \PerspectiveAPI\Connector::addReference($this->getObjectType(), $this->getID(), $this->getStorageCode(), $referenceCode, $objects);

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
        $referenceCode = $this->getProjectContext().'/'.$referenceCode;
        $objects       = self::getReferencedObjectsArray($objects);
        return \PerspectiveAPI\Connector::setReference($this->getObjectType(), $this->getID(), $this->getStorageCode(), $referenceCode, $objects);

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
        $referenceCode = $this->getProjectContext().'/'.$referenceCode;
        $objects       = self::getReferencedObjectsArray($objects);
        return \PerspectiveAPI\Connector::deleteReference($this->getObjectType(), $this->getID(), $this->getStorageCode(), $referenceCode, $objects);

    }//end deleteReference()


    /**
     * Helper function to convert $objects argument to a flat object data array for reference related functions.
     *
     * @param mixed  $objects       One or more objects to add to the reference, retrieved from the store that the
     *                              reference points to.
     *
     * @return array
     * @throws ReadOnlyException Thrown when error occurs.
     */
    private static function getReferencedObjectsArray($objects)
    {
        if (is_array($objects) === false) {
            $objects = [$objects];
        }

        $referencedObjects = [];
        foreach ($objects as $object) {
            if ($object instanceof \PerspectiveAPI\Objects\Types\User) {
                $referencedObjectType = 'user';
            } else if ($object instanceof \PerspectiveAPI\Objects\Types\Group) {
                $referencedObjectType = 'userGroup';
            } else if ($object instanceof \PerspectiveAPI\Objects\Types\DataRecord) {
                $referencedObjectType = 'data';
            } else {
                throw new ReadOnlyException('Invalid referenced object');
            }

            $referencedObjects[] = [
                'id'         => $object->getID(),
                'storeCode'  => $object->getStorageCode(),
                'objectType' => $referencedObjectType,
            ];
        }//end foreach

        return $referencedObjects;

    }//end getReferencedObjectsArray()


}//end interface
