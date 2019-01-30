<?php
/**
 * Sequence class.
 *
 * @package    Perspective
 * @subpackage API
 * @author     Squiz Pty Ltd <products@squiz.net>
 * @copyright  2019 Squiz Pty Ltd (ABN 77 084 670 600)
 */

namespace PerspectiveAPI;

/**
 * Sequence class.
 */
class Request
{

    /**
     * Returns the next value of the specified sequence.
     *
     * @param string $sequenceid The name of the sequence. If the sequence name does not match any existing sequences,
     *                           a new sequence will be created.
     *
     * @return string
     */
    public static function nextval(string $sequenceid)
    {
        return \PerspectiveAPI\Connector::getSequenceNextval($sequenceid);

    }//end nextval()


}//end class
