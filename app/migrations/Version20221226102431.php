<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20221226102431 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        $test = $schema->createTable('test');

        $test->addColumn('id', 'integer', ['autoincrement' => true]);
        $test->addColumn('name_no_index', 'string');
        $test->addColumn('name_with_index', 'string');
        $test->setPrimaryKey(['id']);
        $test->addIndex(['name_with_index'], 'name_index');
    }

    public function down(Schema $schema): void
    {
        $schema->dropTable('test');
    }
}
