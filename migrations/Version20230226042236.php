<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230226042236 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE products CHANGE date date DATE DEFAULT NULL, CHANGE date_created date_created DATE DEFAULT NULL, CHANGE date_created_gmt date_created_gmt DATE DEFAULT NULL, CHANGE date_modified date_modified DATE DEFAULT NULL, CHANGE date_modified_gmt date_modified_gmt DATE DEFAULT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE products CHANGE date date DATE NOT NULL, CHANGE date_created date_created DATE NOT NULL, CHANGE date_created_gmt date_created_gmt DATE NOT NULL, CHANGE date_modified date_modified DATE NOT NULL, CHANGE date_modified_gmt date_modified_gmt DATE NOT NULL');
    }
}
