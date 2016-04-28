<?php

namespace GearmanBundle\Workers;

use GearmanBundle\Driver\Gearman;

/**
 * @Gearman\Work(
 *     name = "FirstWorker",
 *     iterations = 3,
 *     minimumExecutionTime = 3,
 *     timeout = 900,
 *     description = "Worker test description",
 *     defaultMethod = "doNormal",
 *     servers = {
 *         { "host": "127.0.0.1", "port": 4730 }
 *     }
 * )
 */
class FirstWorker
{
    /**
     * Test method to run as a job
     *
     * @param \GearmanJob $job Object with job parameters
     *
     * @return boolean
     *
     * @Gearman\Job(
     *     name = "testA",
     *     iterations = 30,
     *     minimumExecutionTime = 2,
     *     timeout = 300,
     *     description = "This is a description"
     * )
     */
    public function testA(\GearmanJob $job)
    {
        $workload = $job->workload();
        echo "Received job: " . $job->handle() . "\n";
        echo "Workload: $workload\n";
        $result = strrev($workload);
        echo "Result: $result\n";
        return $result;
    }

    /**
     * Test method to run as a job
     *
     * @param \GearmanJob $job Object with job parameters
     *
     * @return boolean
     *
     * @Gearman\Job(
     *     defaultMethod = "doLowBackground"
     * )
     */
    public function testB(\GearmanJob $job)
    {
        $workload = $job->workload();
        echo "Received job: " . $job->handle() . "\n";
        echo "Workload: $workload\n";
        $result = strrev($workload);
        echo "Result: $result\n";
        return $result;
    }

    /**
     * Test method to run as a job
     *
     * @param \GearmanJob $job Object with job parameters
     *
     * @return boolean
     *
     * @Gearman\Job(
     *     defaultMethod = "doNormal"
     * )
     */
    public function snake(\GearmanJob $job)
    {
        echo 'Job snake done!' . PHP_EOL;

        return true;
    }
}
