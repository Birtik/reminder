<?php

declare(strict_types=1);

namespace SharedKernel\Infrastructure\Symfony\Command;

use Exception;
use SharedKernel\Application\Aws\Queue\Process\Process;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

#[AsCommand(name: 'queue:consume')]
final class QueueConsumeCommand extends Command
{
    private Process $process;

    public function __construct(
        Process $process
    ) {
        parent::__construct('queue:consume');
        $this->setDescription('Consume all messages from the `priority-test` queue');
        $this->process = $process;
    }

    public function execute(InputInterface $input, OutputInterface $output): int
    {
        try {
            $this->process->process('priority-test');
        } catch (Exception $e) {
            $output->writeln($e->getMessage());
        }

        return 0;
    }
}