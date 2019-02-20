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
     * The store package.
     *
     * @var string|null
     */
    protected $package = null;

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
    public function __construct(string $package, string $storeid)
    {
        $this->package = $package;
        $this->id      = $storeid;
        $this->code    = $package.'/'.$storeid;

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
     * Gets the store package.
     *
     * @return string
     */
    public function getPackage()
    {
        return $this->package;

    }//end getPackage()


    /**
     * Sets the store package.
     *
     * Can set as the dependant project package so e.g setting property values in this store will look at the
     * dependant project properties.
     *
     * @return string
     */
    public function setPackage(string $package)
    {
        $this->package = $package;

    }//end setPackage()


}//end class
