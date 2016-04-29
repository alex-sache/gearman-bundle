<?php

namespace EduardTrandafir\GearmanBundle\Command\Util;

use Symfony\Component\Console\Output\OutputInterface;

/**
 * Interface GearmanOutputAwareInterface
 */
interface GearmanOutputAwareInterface
{
    /**
     * Set the output
     *
     * @param OutputInterface $output
     */
    public function setOutput(OutputInterface $output);
}
