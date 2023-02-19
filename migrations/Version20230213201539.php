<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230213201539 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE product_variation (id INT AUTO_INCREMENT NOT NULL, id_variation VARCHAR(255) DEFAULT NULL, date_created VARCHAR(255) DEFAULT NULL, description LONGTEXT DEFAULT NULL, sku VARCHAR(255) DEFAULT NULL, price VARCHAR(255) DEFAULT NULL, regular_price VARCHAR(255) DEFAULT NULL, sale_price VARCHAR(255) DEFAULT NULL, status VARCHAR(255) DEFAULT NULL, stock_status VARCHAR(255) DEFAULT NULL, id_product VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE product_variation');
    }
}
