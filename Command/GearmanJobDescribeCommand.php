<?php

namespace GearmanBundle\Command;

use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use GearmanBundle\Command\Abstracts\AbstractGearmanCommand;
use GearmanBundle\Service\GearmanClient;
use GearmanBundle\Service\GearmanDescriber;

class GearmanJobDescribeCommand extends AbstractGearmanCommand
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
     * @return GearmanJobDescribeCommand self Object
     */
    public function setGearmanClient(GearmanClient $gearmanClient)
    {
        $this->gearmanClient = $gearmanClient;
        return $this;
    }

    /**
     * Set Gearman describer
     *
     * @param GearmanDescriber $gearmanDescriber GearmanDescriber
     *
     * @return GearmanJobDescribeCommand self Object
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
        $this
            ->setName('gearman:job:describe')
            ->setDescription('Describe given job')
            ->addArgument(
                'job',
                InputArgument::REQUIRED,
                'job to describe'
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
        $job = $input->getArgument('job');
        $job = $this->gearmanClient->getJob($job);
        $this
            ->gearmanDescriber
            ->describeJob($output, $job);
    }
}
