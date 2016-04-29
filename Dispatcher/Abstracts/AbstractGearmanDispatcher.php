<?php

namespace EduardTrandafir\GearmanBundle\Dispatcher\Abstracts;

use Symfony\Component\EventDispatcher\EventDispatcherInterface;

/**
 * Gearman execute methods. All Worker methods
 */
abstract class AbstractGearmanDispatcher
{
    /**
     * @var EventDispatcherInterface
     *
     * Event dispatcher
     */
    protected $eventDispatcher;

    /**
     * Construct method
     *
     * @param EventDispatcherInterface $eventDispatcher Event dispatcher
     */
    public function __construct(EventDispatcherInterface $eventDispatcher)
    {
        $this->eventDispatcher = $eventDispatcher;
    }
}
