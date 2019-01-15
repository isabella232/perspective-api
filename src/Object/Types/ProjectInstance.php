<?php
/**
 * Instance base class.
 *
 * All public methods should be marked as final (can not be overriden).
 *
 * @package    Perspective
 * @subpackage API
 * @author     Squiz Pty Ltd <products@squiz.net>
 * @copyright  2019 Squiz Pty Ltd (ABN 77 084 670 600)
 */

namespace PerspectiveAPI\Object\Types;

use \PerspectiveAPI\Object\Object as Object;

/**
 * ProjectInstance Class.
 */
class ProjectInstance extends Object
{


    /**
     * Construct function for Project Instance.
     *
     * @param string $id The id of the project.
     *
     * @return void
     */
    public function __construct(string $id)
    {
        $this->id = $id;

    }//end __construct()


}//end class
