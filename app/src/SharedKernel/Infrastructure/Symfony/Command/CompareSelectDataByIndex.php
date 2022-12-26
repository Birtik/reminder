<?php

declare(strict_types=1);

namespace SharedKernel\Infrastructure\Symfony\Command;

use Doctrine\DBAL\Connection;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

final class CompareSelectDataByIndex extends Command
{
    private Connection $connection;

    public function __construct(Connection $connection) {
        parent::__construct('app:compare');
        $this->setDescription('Compare select data by index');
        $this->connection = $connection;
    }

    public function execute(InputInterface $input, OutputInterface $output): int
    {
        $executionTimeStart = microtime(true);
        $this->connection->fetchOne('SELECT * FROM test WHERE name_no_index = ?', ['value_750']);
        $executionTimeStop = microtime(true);
        $timeNoIndex = $executionTimeStop - $executionTimeStart;

        $executionTimeStart = microtime(true);
        $this->connection->fetchOne('SELECT * FROM test WHERE name_with_index = ?', ['value_i_750']);
        $executionTimeStop = microtime(true);
        $timeWithIndex = $executionTimeStop - $executionTimeStart;

        $output->writeln("Time with no index: $timeNoIndex");
        $output->writeln("Time with index: $timeWithIndex");

        return 0;
    }
}