<?php

namespace EduardTrandafir\GearmanBundle\Exceptions;

use EduardTrandafir\GearmanBundle\Exceptions\Abstracts\AbstractGearmanException;

/**
 * GearmanBundle can't find worker specified as Gearman format Exception
 */
class WorkerDoesNotExistException extends AbstractGearmanException
{

}
