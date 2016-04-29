<?php

namespace EduardTrandafir\GearmanBundle\Event;

use Symfony\Component\EventDispatcher\Event;

/**
 * GearmanWorkStartingEvent
 */
class GearmanWorkStartingEvent extends Event
{
    /**
     * @var array
     *
     * Gearman jobs running
     */
    protected $jobs;

    /**
     * Construct method
     *
     * @param array $jobs Jobs
     */
    public function __construct(array $jobs)
    {
        $this->jobs = $jobs;
    }

    /**
     * Get Gearman Work subscribed jobs
     *
     * @return array Subscribed jobs
     */
    public function getJobs()
    {
        return $this->jobs;
    }
}
