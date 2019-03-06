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

namespace PerspectiveAPI\Objects\Types;

use \PerspectiveAPI\Objects\AbstractObject as AbstractObject;

/**
 * ProjectInstance Class.
 */
class ProjectInstance extends AbstractObject
{

    /**
     * The project context.
     *
     * @var string
     */
    protected $projectContext = null;

    /**
     * Construct function for Project Instance.
     *
     * @param string $id The id of the project.
     *
     * @return void
     */
    public function __construct(string $id, string $projectContext)
    {
        if (\PerspectiveAPI\Init::isValidID($id) === false) {
            throw new \PerspectiveAPI\Exception\InvalidDataException(
                sprintf(
                    _('Invalid Project Instance id (%s)'),
                    $id
                )
            );
        }

        $this->id             = $id;
        $this->projectContext = $projectContext;

    }//end __construct()


}//end class
