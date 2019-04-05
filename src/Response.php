<?php
/**
 * Response class.
 *
 * @package    Perspective
 * @subpackage API
 * @author     Squiz Pty Ltd <products@squiz.net>
 * @copyright  2019 Squiz Pty Ltd (ABN 77 084 670 600)
 */

namespace PerspectiveAPI;

/**
 * Cache class.
 */
class Response
{

    /**
     * Use when you need to send headers.
     *
     * @param string  $header           The header string to send.
     * @param boolean $replace          The optional replace parameter indicates whether the header should replace a
     *                                  previous similar header, or add a second header of the same type.  By default it
     *                                  will replace, but if you pass in FALSE as the second argument you can force
     *                                  multiple headers of the same type.
     * @param integer $httpResponseCode Forces the HTTP response code to the specified value.
     *
     * @return void
     */
    public static function sendHeader(string $header, bool $replace=true, int $httpResponseCode=null)
    {
        \PerspectiveAPI\Connector::sendHeader($header, $replace, $httpResponseCode);

    }//end sendHeader()

}//end class
