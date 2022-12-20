<?php

declare(strict_types=1);

namespace SharedKernel\Infrastructure\Symfony\Command;

use DateTime;
use Doctrine\DBAL\Connection;
use Exception;
use SharedKernel\Application\Aws\Queue\Process\Transport;
use SharedKernel\Infrastructure\Aws\Sqs\SqsMessage;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class FinishDayCommand extends Command
{
    public function __construct(
        private Transport $transport,
        private Connection $connection,
    ) {
        parent::__construct('app:finish:day');
        $this->setDescription('Command which is turned on every 11:50PM');
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

        $this->createActivityForNextDay();

        return 0;
    }

    /**
     * @throws \Doctrine\DBAL\Exception
     */
    private function createActivityForNextDay(): void
    {
        $sql = <<<SQL
INSERT INTO days (activity_id, date, complete)
SELECT id, ?, false FROM activity
SQL;

        $tomorrowDate = (new DateTime())->modify('+1 day');
        $this->connection->executeQuery($sql, [$tomorrowDate->format("Y-m-d")]);
    }
}