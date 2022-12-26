<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use DateTime;
use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20221226134651 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        $this->connection->insert(
            'days',
            [
                'id' => 1,
                'activity_id' => 1,
                'date' => (new DateTime())->format("Y-m-d"),
                'complete' => 0,
            ]
        );

        $this->connection->insert(
            'days',
            [
                'id' => 2,
                'activity_id' => 2,
                'date' => (new DateTime())->format("Y-m-d"),
                'complete' => 0,
            ]
        );

        $this->connection->insert(
            'days',
            [
                'id' => 3,
                'activity_id' => 3,
                'date' => (new DateTime())->format("Y-m-d"),
                'complete' => 0,
            ]
        );
    }
}
