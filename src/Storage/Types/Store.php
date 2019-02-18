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
     * The store namespace.
     *
     * @var string|null
     */
    protected $namespace = null;

     /**
     * The store code.
     *
     * @var string|null
     */
    protected $code = null;

    /**
     * Constructor for Store Class.
     *
     * @param string $storeid The storeid.
     *
     * @return void
     */
    public function __construct(string $namespace, string $storeid)
    {
        $this->id        = $storeid;
        $this->namespace = $namespace;
        $this->code      = $this->namespace.'/'.$this->id;

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
     * Gets the store code.
     *
     * @return string
     */
    public function getCode()
    {
        return $this->code;

    }//end getCode()


    /**
     * Gets the store namespace.
     *
     * @return string
     */
    public function getNamespace()
    {
        return $this->namespace;

    }//end getNamespace()


    /**
     * Sets the store namespace.
     *
     * Can set as the dependant project namespace so e.g setting property values in this store will look at the
     * dependant project properties.
     *
     * @return string
     */
    public function setNamespace(string $namespace)
    {
        $this->namespace = $namespace;

    }//end getNamespace()


}//end class
