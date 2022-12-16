<?php

declare(strict_types=1);

namespace SharedKernel\Infrastructure\Symfony\Command;

use Exception;
use SharedKernel\Application\Aws\Queue\Process\Transport;
use SharedKernel\Infrastructure\Aws\Sqs\SqsMessage;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class FinishDayCommand extends Command
{
    public function __construct(private Transport $transport)
    {
        parent::__construct('app:finish:day');
        $this->setDescription('Command which is turned on every ex. 11:00PM');
    }

    public function execute(InputInterface $input, OutputInterface $output): int
    {
        try {
            $this->transport->sendMessage(
                new SqsMessage([
                    'action' => 'update-day',
                    'data' => [],
                ]),
                'priority-test'
            );
        } catch (Exception $e) {
            $output->writeln($e->getMessage());
        }

        return 0;
    }
}