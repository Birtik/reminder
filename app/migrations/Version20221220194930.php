<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20221220194930 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        $this->connection->insert('activity', ['name' => 'activity_1']);
        $this->connection->insert('activity', ['name' => 'activity_2']);
        $this->connection->insert('activity', ['name' => 'activity_3']);
    }
}
