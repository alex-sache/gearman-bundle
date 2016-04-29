<?php

namespace EduardTrandafir\GearmanBundle\Driver\Gearman;

use Doctrine\Common\Annotations\Annotation;

/**
 * Gearman Job annotation driver
 *
 * @Annotation
 */
class Job extends Annotation
{
    /**
     * Method name to assign into job
     *
     * @var string
     */
    public $name;

    /**
     * Description of Job
     *
     * @var string
     */
    public $description;

    /**
     * Number of iterations specified for this job
     *
     * @var integer
     */
    public $iterations;

    /**
     * Servers assigned for this job to be executed
     *
     * @var mixed
     */
    public $servers;

    /**
     * Default method to call for this job
     *
     * @var string
     */
    public $defaultMethod;

    /**
     * Timeout in seconds for job idle time
     *
     * @var int
     */
    public $timeout;

    /**
     * @var int
     *
     * Number of seconds the execution must run before being allowed to terminate
     */
    public $minimumExecutionTime;
}
