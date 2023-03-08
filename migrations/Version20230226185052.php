<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230226185052 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE orders DROP productos, CHANGE date_created date_created DATETIME DEFAULT NULL, CHANGE date_modified date_modified DATETIME DEFAULT NULL, CHANGE discount_total discount_total DOUBLE PRECISION DEFAULT NULL, CHANGE discount_tax discount_tax DOUBLE PRECISION DEFAULT NULL, CHANGE shipping_total shipping_total DOUBLE PRECISION DEFAULT NULL, CHANGE shipping_tax shipping_tax DOUBLE PRECISION DEFAULT NULL, CHANGE cart_tax cart_tax DOUBLE PRECISION DEFAULT NULL, CHANGE total total DOUBLE PRECISION DEFAULT NULL, CHANGE prices_include_tax prices_include_tax DOUBLE PRECISION DEFAULT NULL, CHANGE date_paid date_paid DATETIME DEFAULT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE orders ADD productos LONGTEXT DEFAULT NULL COMMENT \'(DC2Type:array)\', CHANGE date_created date_created VARCHAR(255) DEFAULT NULL, CHANGE date_modified date_modified VARCHAR(255) DEFAULT NULL, CHANGE discount_total discount_total VARCHAR(255) DEFAULT NULL, CHANGE discount_tax discount_tax VARCHAR(255) DEFAULT NULL, CHANGE shipping_total shipping_total VARCHAR(255) DEFAULT NULL, CHANGE shipping_tax shipping_tax VARCHAR(255) DEFAULT NULL, CHANGE cart_tax cart_tax VARCHAR(255) DEFAULT NULL, CHANGE total total VARCHAR(255) DEFAULT NULL, CHANGE prices_include_tax prices_include_tax VARCHAR(255) DEFAULT NULL, CHANGE date_paid date_paid VARCHAR(255) DEFAULT NULL');
    }
}
