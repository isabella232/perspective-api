<?php
/**
 * WebPush class.
 *
 * @package    Perspective
 * @subpackage API
 * @author     Squiz Pty Ltd <products@squiz.net>
 * @copyright  2019 Squiz Pty Ltd (ABN 77 084 670 600)
 */

namespace PerspectiveAPI;

/**
 * WebPush  class.
 */
class WebPush
{

    /**
     * Sends a notification to subscriptions.
     *
     * Returns a array of error messages for failed pushes.
     *
     * @param array $subscriptions Array of subscription content.
     * @param string $payload      The payload of message to send.
     * @param array $VAPID         Array of the VAPID settings.
     *
     * @return array
     */
    public static function sendNotification(array $subscriptions, string $payload='', array $VAPID)
    {
        return \PerspectiveAPI\Connector::sendWebPushNotification($subscriptions, $payload, $VAPID);

    }//end sendNotification()


}//end class
