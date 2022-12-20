<?php

declare(strict_types=1);

namespace Progress\Infrastructure\Dbal\Query;

use Doctrine\DBAL\Connection;
use Doctrine\DBAL\Exception;
use Progress\Application\Query\GetAllDaysQuery;
use Progress\Application\View\FinishedDaysViewCollection;
use Progress\Application\View\FinishedDayView;

final class DbalGetAllDaysQuery implements GetAllDaysQuery
{
    public function __construct(private Connection $connection)
    {
    }

    /**
     * @throws Exception
     */
    public function __invoke(): FinishedDaysViewCollection
    {
        $collection = [];

        $sql = <<<SQL
SELECT d.date, a.name, d.complete 
FROM days d
LEFT JOIN activity a ON d.activity_id = a.id
SQL;

       $days = $this->connection->fetchAllAssociative($sql);

       foreach ($days as $day) {
           $collection[] = new FinishedDayView($day['date'], $day['name']);
       }

       return new FinishedDaysViewCollection(...$collection);
    }
}