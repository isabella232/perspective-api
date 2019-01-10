<?php
/**
 * DataStore class.
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
     * The data store code.
     *
     * @var string|null
     */
    protected $code = null;


    /**
     * Constructor for DataStore Class.
     *
     * @param string $code The name of the user store.
     *
     * @return void
     */
    public function __construct(string $code)
    {
        $this->code = $code;

    }//end __construct()


}//end class
