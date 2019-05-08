<?php
/**
 * Store class.
 *
 * @package    Perspective
 * @subpackage API
 * @author     Squiz Pty Ltd <products@squiz.net>
 * @copyright  2019 Squiz Pty Ltd (ABN 77 084 670 600)
 */

namespace PerspectiveAPI\Storage\Types;


/**
 * Store Class.
 */
abstract class Store
{

    /**
     * The store id.
     *
     * @var string|null
     */
    protected $id = null;

     /**
      * The store code.
      *
      * @var string|null
      */
    protected $code = null;

    /**
     * The store project context.
     *
     * To enable use of property/reference values on object from a parent project used inside a depedant project.
     *
     * @var string|null
     */
    protected $projectContext = null;


    /**
     * Constructor for Store Class.
     *
     * @param string $storeCode The store code.
     *
     * @return void
     */
    public function __construct(string $storeCode, string $projectContext=null)
    {
        $this->id   = basename($storeCode);
        $this->code = $storeCode;
        if ($projectContext === null) {
            $projectContext = dirname($storeCode);
        }

        $this->projectContext = $projectContext;

    }//end __construct()


    /**
     * Gets the store id.
     *
     * @return string
     */
    public function getID()
    {
        return $this->id;

    }//end getID()


    /**
     * Gets the store code
     *
     * @return string
     * @internal
     */
    public function getCode()
    {
        return $this->code;

    }//end getCode()


    /**
     * Gets the store project context.
     *
     * @return string
     * @internal
     */
    public function getProjectContext()
    {
        return $this->projectContext;

    }//end getProjectContext()


    /**
     * Sets the store project context.
     *
     * @return void
     * @internal
     */
    public function setProjectContext(string $projectContext)
    {
        if (\PerspectiveAPI\Connector::projectExists($projectContext) === false) {
            throw new \PerspectiveAPI\Exception\InvalidDataException('Project doesn\'t exist.');
        }

        $this->projectContext = $projectContext;

    }//end setProjectContext()


    /**
     * Return whether store owns the project context.
     *
     * Only property/reference value operations allowed out of own project context.
     *
     * @return boolean
     * @internal
     */
    public function ownProjectContext()
    {
        if (dirname($this->code) === $this->projectContext) {
            return true;
        }

        return false;

    }//end ownProjectContext()


    /**
     * Call to get a store object by a unqiue propery value.
     *
     * @param string $baseType   Getting a dataRecord|user|group.
     * @param string $propertyid The propertyid to search.
     * @param string $value      The value to search by.
     *
     * @return object
     */
    protected function getStoreObjectByUniquePropertyValue(string $baseType, string $propertyid, string $value)
    {
        if (\PerspectiveAPI\Init::validatePropertyid($propertyid) === false) {
            throw new \PerspectiveAPI\Exception\InvalidDataException(
                sprintf(
                    'Invalid propertyid (%s)',
                    $propertyid
                )
            );
        }

        $propertyid = $this->projectContext.'/'.$propertyid;
        $objectInfo = \PerspectiveAPI\Connector::getObjectInfoByUniquePropertyValue(
            $baseType,
            $this->code,
            $propertyid,
            $value
        );

        if ($objectInfo === null) {
            return null;
        }

        if (class_exists($objectInfo['typeClass']) === false) {
            throw new \Exception('Type class can not be found');
        }

        return $this->getStoreObjectFromObjectInfo($baseType, $objectInfo);

    }//end getStoreObjectByUniquePropertyValue()


    /**
     * Given object info for a type it will return the object.
     *
     * @param string $baseType   Getting a dataRecord|user|group.
     * @param array  $objectInfo Object info applicable to instantiating that type.
     *
     * @return object
     */
    abstract protected function getStoreObjectFromObjectInfo(string $baseType, array $objectInfo);


    /**
     * Returns a flat list of data record's children including their dataRecordid and level.
     *
     * @param integer $depth The max depth.
     *
     * @return array
     */
    abstract protected function getChildren(int $depth=null);


}//end class
