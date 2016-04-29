<?php

namespace EduardTrandafir\GearmanBundle\Command;

use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

use EduardTrandafir\GearmanBundle\Command\Abstracts\AbstractGearmanCommand;
use EduardTrandafir\GearmanBundle\Service\GearmanClient;
use EduardTrandafir\GearmanBundle\Service\GearmanDescriber;
use EduardTrandafir\GearmanBundle\Service\GearmanExecute;
use Symfony\Component\Console\Question\ConfirmationQuestion;

/**
 * Gearman Worker Execute Command class
 *
 * @since 2.3.1
 */
class GearmanWorkerExecuteCommand extends AbstractGearmanCommand
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
     * @var GearmanExecute
     *
     * Gearman execute
     */
    protected $gearmanExecute;

    /**
     * Set gearman client
     *
     * @param GearmanClient $gearmanClient Gearman client
     *
     * @return GearmanWorkerExecuteCommand self Object
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
     * @return GearmanWorkerExecuteCommand self Object
     */
    public function setGearmanDescriber(GearmanDescriber $gearmanDescriber)
    {
        $this->gearmanDescriber = $gearmanDescriber;

        return $this;
    }

    /**
     * set Gearman execute
     *
     * @param GearmanExecute $gearmanExecute GearmanExecute
     *
     * @return GearmanWorkerExecuteCommand self Object
     */
    public function setGearmanExecute(GearmanExecute $gearmanExecute)
    {
        $this->gearmanExecute = $gearmanExecute;

        return $this;
    }

    /**
     * Console Command configuration
     */
    protected function configure()
    {
        parent::configure();

        $this
            ->setName('gearman:worker:execute')
            ->setDescription('Execute one worker with all contained Jobs')
            ->addArgument(
                'worker',
                InputArgument::REQUIRED,
                'work to execute'
            )
            ->addOption(
                'no-description',
                null,
                InputOption::VALUE_NONE,
                'Don\'t print worker description'
            )
            ->addOption(
                'iterations',
                null,
                InputOption::VALUE_OPTIONAL,
                'Override configured iterations'
            )
            ->addOption(
                'minimum-execution-time',
                null,
                InputOption::VALUE_OPTIONAL,
                'Override configured minimum execution time'
            )
            ->addOption(
                'timeout',
                null,
                InputOption::VALUE_OPTIONAL,
                'Override configured timeout'
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
        $helper = $this->getHelper('question');
        $question = new ConfirmationQuestion('<question>This will execute asked worker with all its jobs?</question>', 'y');

        if (!$input->getOption('no-interaction') &&
            !$helper->ask(
                $input,
                $output,
                $question
            )) {
            return;
        }

        if (!$input->getOption('quiet')) {

            $output->writeln(sprintf(
                '<info>[%s] loading...</info>',
                date('Y-m-d H:i:s')
            ));
        }

        $worker = $input->getArgument('worker');

        $workerStructure = $this
            ->gearmanClient
            ->getWorker($worker);

        if (!$input->getOption('no-description') &&
            !$input->getOption('quiet')) {
            $this
                ->gearmanDescriber
                ->describeWorker(
                    $output,
                    $workerStructure,
                    true
                );
        }

        if (!$input->getOption('quiet')) {

            $output->writeln(sprintf(
                '<info>[%s] loaded. Ctrl+C to break</info>',
                date('Y-m-d H:i:s')
            ));
        }

        $this
            ->gearmanExecute
            ->setOutput($output)
            ->executeWorker($worker, array(
                'iterations'             => $input->getOption('iterations'),
                'minimum_execution_time' => $input->getOption('minimum-execution-time'),
                'timeout'                => $input->getOption('timeout')
            ));
    }
}
