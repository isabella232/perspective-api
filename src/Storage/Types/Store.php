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

    }//end getId()


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


}//end class
