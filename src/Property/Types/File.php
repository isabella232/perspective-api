<?php
/**
 * File property base class.
 *
 * @package    Perspective
 * @subpackage API
 * @author     Squiz Pty Ltd <products@squiz.net>
 * @copyright  2019 Squiz Pty Ltd (ABN 77 084 670 600)
 */

namespace PerspectiveAPI\Property\Types;

use \PerspectiveAPI\Property\Types\Property as Property;
use \PerspectiveAPI\Property\FileInterface as FileInterface;

/**
 * File Class.
 */
abstract class File extends Property implements FileInterface
{

}//end class
