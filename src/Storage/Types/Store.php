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
     * The store code.
     *
     * @var string|null
     */
    protected $code = null;


    /**
     * Constructor for Store Class.
     *
     * @param string $code The code of the store.
     *
     * @return void
     */
    public function __construct(string $code)
    {
        $this->code = $code;

    }//end __construct()


    /**
     * Gets the store code.
     *
     * @return string
     */
    public function getCode()
    {
        return $this->code;

    }//end getCode()


}//end class
