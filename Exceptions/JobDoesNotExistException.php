<?php

namespace GearmanBundle\Exceptions;

use GearmanBundle\Exceptions\Abstracts\AbstractGearmanException;

/**
 * GearmanBundle can't find job specified as Gearman format Exception
 */
class JobDoesNotExistException extends AbstractGearmanException
{

}
