<?php

declare(strict_types=1);

namespace SharedKernel\Application\Aws\Queue\Process\Consumer;

use DateTime;
use Doctrine\DBAL\Connection;
use SharedKernel\Application\Aws\DynamoDb\KeyValueDatabaseClient;
use SharedKernel\Application\Aws\Queue\Message;
use SharedKernel\Application\Aws\Queue\Process\Consumer;
use Exception;

final class UpdateDayCompletion implements Consumer
{
    private const ACTION_NAME = 'update-day';

    public function __construct(
        private Connection $connection,
        private KeyValueDatabaseClient $dayCompletedDb,
    ) {
    }

    public function getAction(): string
    {
        return self::ACTION_NAME;
    }

    public function process(Message $message): void
    {
        $date = new DateTime();

        try {
            $this->dayCompletedDb->update(
                ['date' => $date->format('d-m-y')],
                ['complete' => $this->determineFullCompletedDay($date)]
            );
        } catch (Exception $e) {
            dump($e->getMessage());
        }
    }

    /**
     * @throws \Doctrine\DBAL\Exception
     */
    private function determineFullCompletedDay(DateTime $dateTime): bool
    {
        $results = $this->connection->fetchFirstColumn(
            'SELECT complete FROM days WHERE date = ?',
            [$dateTime->format('Y-m-d')],
        );

        foreach ($results as $result) {
            if(false === $result) {
                return false;
            }
        }

        return true;
    }
}