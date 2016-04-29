<?php
namespace EduardTrandafir\GearmanBundle\Workers;

use EduardTrandafir\GearmanBundle\Driver\Gearman;
use Symfony\Component\DependencyInjection\Container;

/**
 * @Gearman\Work(
 *     name = "TestWorker",
 *     iterations = 3,
 *     minimumExecutionTime = 3,
 *     timeout = 20,
 *     description = "Worker test description",
 *     defaultMethod = "doBackground",
 *     servers = {
 *         { "host": "127.0.0.1", "port": 4730 }
 *     }
 * )
 */
class TestWorker
{
    private $container;
    public function __construct(Container $container)
    {
        $this->container = $container;
    }
    /**
     * Test method to run as a job
     *
     * @param \GearmanJob $job Object with job parameters
     *
     * @return boolean
     *
     * @Gearman\Job(
     *     name = "sendNotificationsToUsers",
     *     description = "Sends a list users an awesome notification"
     * )
     */
    public function sendNotificationsToUsers(\GearmanJob $job)
    {
        // Get the data we put in for the job previously.
        $data = json_decode($job->workload(), true);

//        foreach ($data['user_ids'] as $userId)
//        {
            error_log($userId);
//        }
    }
}
