<?php

namespace EduardTrandafir\GearmanBundle\Command;

use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use EduardTrandafir\GearmanBundle\Command\Abstracts\AbstractGearmanCommand;
use EduardTrandafir\GearmanBundle\Command\GearmanJobDescribeCommand;
use EduardTrandafir\GearmanBundle\Service\GearmanClient;

/**
 * Gearman Job List Command class
 */
class GearmanWorkerListCommand extends AbstractGearmanCommand
{
    /**
     * @var GearmanClient
     *
     * Gearman client
     */
    protected $gearmanClient;
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
     * Console Command configuration
     */
    protected function configure()
    {
        parent::configure();
        $this
            ->setName('gearman:worker:list')
            ->setDescription('List all Gearman Workers and their Jobs');
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
        if ($input->getOption('quiet')) {
            return;
        }
        $workers = $this->gearmanClient->getWorkers();
        if (is_array($workers)) {
            $it = 1;
            foreach ($workers as $worker) {
                $output->writeln('<comment>@Worker:  </comment><info>' . $worker['className'] . '</info>');
                $output->writeln('<comment>callablename:  </comment><info>' . $worker['callableName'] . '</info>');
                $output->writeln('<comment>Jobs:</comment>');
                foreach ($worker['jobs'] as $job) {
                    $output->writeln('<comment>  - #' . $it++ . '</comment>');
                    $output->writeln('<comment>      name: ' . $job['methodName'] . '</comment>');
                    $output->writeln('<comment>      callablename:</comment><info> ' . $job['realCallableNameNoPrefix'] . '</info>');
                    if (false === is_null($job['jobPrefix'])) {
                        $output->writeln('<comment>      jobPrefix:</comment><info> ' . $job['jobPrefix'] . '</info>');
                    }
                }
            }
        }
    }
}
