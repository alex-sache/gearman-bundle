<?php

namespace EduardTrandafir\GearmanBundle\Exceptions;

use Exception;

use EduardTrandafir\GearmanBundle\Exceptions\Abstracts\AbstractGearmanException;

/**
 * GearmanBundle can't find worker specified as Gearman format Exception
 */
class WorkerNameTooLongException extends AbstractGearmanException
{

    /**
     * Construction method
     *
     * @param string    $message  Message
     * @param int       $code     Code
     * @param Exception $previous Previous
     */
    public function __construct($message = null, $code = 0, Exception $previous = null)
    {
        $message = 'The function name + unique id cannot exceed 114 bytes.
                    You can change workers name or set a shortly unique key';

        parent::__construct($message, $code, $previous);
    }
}
