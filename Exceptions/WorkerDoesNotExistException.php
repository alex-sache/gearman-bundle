<?php

namespace GearmanBundle\Exceptions;

use GearmanBundle\Exceptions\Abstracts\AbstractGearmanException;

/**
 * GearmanBundle can't find worker specified as Gearman format Exception
 */
class WorkerDoesNotExistException extends AbstractGearmanException
{

}
