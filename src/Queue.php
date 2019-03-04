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
     * Current namespace
     *
     * @var string
     */
    private static function getProjectContext()
    {
        // Can't be statically cached as Queue class can be called from different projects in a single process.
        $namespace      = str_replace('\Framework\Queue', '', static::class);
        $projectContext = strtolower(\PerspectiveAPI\Connector::getProjectContext($namespace));
        return $projectContext;

    }//end getProjectContext()


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
        $projectContext = self::getProjectContext();
        foreach ($queueNames as &$queueName) {
            $queueName = $projectContext.'/'.$queueName;
        }

        unset($queueName);

        return \PerspectiveAPI\Connector::addQueueJob($queueNames, $data, $successCallback, $failedCallback);

    }//end addJob()

}//end class
