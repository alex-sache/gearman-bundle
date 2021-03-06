<?php

namespace EduardTrandafir\GearmanBundle\Command;

use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

use EduardTrandafir\GearmanBundle\Command\Abstracts\AbstractGearmanCommand;
use EduardTrandafir\GearmanBundle\Service\GearmanClient;
use EduardTrandafir\GearmanBundle\Service\GearmanDescriber;

/**
 * Gearman Job Describe Command class
 */
class GearmanWorkerDescribeCommand extends AbstractGearmanCommand
{
    /**
     * @var GearmanClient
     *
     * Gearman client
     */
    protected $gearmanClient;

    /**
     * @var GearmanDescriber
     *
     * GearmanDescriber
     */
    protected $gearmanDescriber;

    /**
     * Set gearman client
     *
     * @param GearmanClient $gearmanClient Gearman client
     *
     * @return GearmanWorkerDescribeCommand self Object
     */
    public function setGearmanClient(GearmanClient $gearmanClient)
    {
        $this->gearmanClient = $gearmanClient;

        return $this;
    }

    /**
     * set Gearman describer
     *
     * @param GearmanDescriber $gearmanDescriber GearmanDescriber
     *
     * @return GearmanWorkerDescribeCommand self Object
     */
    public function setGearmanDescriber(GearmanDescriber $gearmanDescriber)
    {
        $this->gearmanDescriber = $gearmanDescriber;

        return $this;
    }

    /**
     * Console Command configuration
     */
    protected function configure()
    {
        parent::configure();

        $this
            ->setName('gearman:worker:describe')
            ->setDescription('Describe given worker')
            ->addArgument(
                'worker',
                InputArgument::REQUIRED,
                'worker to describe'
            );
    }

    /**
     * Executes the current command.
     *
     * @param InputInterface  $input  An InputInterface instance
     * @param OutputInterface $output An OutputInterface instance
     *
     * @return integer 0 if everything went fine, or an error code
     *
     * @throws \LogicException When this abstract class is not implemented
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $worker = $input->getArgument('worker');
        $worker = $this
            ->gearmanClient
            ->getWorker($worker);

        $this
            ->gearmanDescriber
            ->describeWorker(
                $output,
                $worker
            );
    }
}
