<?php

namespace GearmanBundle\Command\Abstracts;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\HttpKernel\KernelInterface;

/**
 * Class AbstractGearmanCommand
 */
abstract class AbstractGearmanCommand extends Command
{
    /**
     * @var KernelInterface
     *
     * Kernel
     */
    protected $kernel;
    /**
     * Set kernel
     *
     * @param KernelInterface $kernel Kernel
     *
     * @return AbstractGearmanCommand self Object
     */
    public function setKernel(KernelInterface $kernel)
    {
        $this->kernel = $kernel;
        return $this;
    }
}
