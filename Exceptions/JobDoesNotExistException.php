<?php

namespace EduardTrandafir\GearmanBundle\Exceptions;

use EduardTrandafir\GearmanBundle\Exceptions\Abstracts\AbstractGearmanException;

/**
 * GearmanBundle can't find job specified as Gearman format Exception
 */
class JobDoesNotExistException extends AbstractGearmanException
{

}
