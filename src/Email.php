<?php
/**
 * Email base class.
 *
 * @package    Perspective
 * @subpackage API
 * @author     Squiz Pty Ltd <products@squiz.net>
 * @copyright  2019 Squiz Pty Ltd (ABN 77 084 670 600)
 */

namespace PerspectiveAPI;

/**
 * Email class.
 */
class Email
{

    /**
     * Returns an email.
     *
     * @param string $to      Receipent email address.
     * @param string $from    Sender email address.
     * @param string $subject The subject of the email.
     * @param string $message The message of the email.
     *
     * @return void
     */
    public static function sendEmail(string $to, string $from, string $subject, string $message)
    {
        \PerspectiveAPI\Connector::sendEmail($to, $from, $subject, $message);

    }//end sendEmail()


}//end class
