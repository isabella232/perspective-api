<?php
/**
 * Queue base class.
 *
 * @package    Perspective
 * @subpackage API
 * @author     Squiz Pty Ltd <products@squiz.net>
 * @copyright  2019 Squiz Pty Ltd (ABN 77 084 670 600)
 */

namespace PerspectiveAPI;

/**
 * Queue class.
 */
class Queue
{


    /**
     * Queue job.
     *
     * @param mixed    $queueNames      The queue name(s) to queue this job up with.
     * @param mixed    $jobData         The data for the job that is being queued.
     * @param callable $successCallback An optional callback we will call on successful creation of the job.
     * @param callable $failedCallback  An optional callback we will call on failure to create the job.
     *
     * @return void
     */
    public static function addJob(
        $queueNames,
        $data,
        callable $successCallback=null,
        callable $failedCallback=null
    ) {
        return \PerspectiveAPI\Connector::addQueueJob($queueNames, $data, $successCallback, $failedCallback);

    }//end addJob()

}//end class
