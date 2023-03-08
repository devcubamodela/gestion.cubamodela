<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230224191853 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE products (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) DEFAULT NULL, sku VARCHAR(255) DEFAULT NULL, amount VARCHAR(255) DEFAULT NULL, picture VARCHAR(255) DEFAULT NULL, brand VARCHAR(255) DEFAULT NULL, date DATE NOT NULL, slug VARCHAR(255) DEFAULT NULL, permalink VARCHAR(255) DEFAULT NULL, date_created DATE NOT NULL, date_created_gmt DATE NOT NULL, date_modified DATE NOT NULL, date_modified_gmt DATE NOT NULL, type VARCHAR(255) DEFAULT NULL, status VARCHAR(255) DEFAULT NULL, featured VARCHAR(255) DEFAULT NULL, catalog_visibility VARCHAR(255) DEFAULT NULL, description VARCHAR(255) DEFAULT NULL, short_description VARCHAR(255) DEFAULT NULL, price VARCHAR(255) DEFAULT NULL, regular_price VARCHAR(255) DEFAULT NULL, date_on_sale_from VARCHAR(255) DEFAULT NULL, date_on_sale_from_gmt VARCHAR(255) DEFAULT NULL, date_on_sale_to VARCHAR(255) DEFAULT NULL, date_on_sale_to_gmt VARCHAR(255) DEFAULT NULL, on_sale VARCHAR(255) DEFAULT NULL, total_sales VARCHAR(255) DEFAULT NULL, stock_quantity VARCHAR(255) DEFAULT NULL, stock_status VARCHAR(255) DEFAULT NULL, backorders VARCHAR(255) DEFAULT NULL, backorders_allowed VARCHAR(255) DEFAULT NULL, sold_individuality VARCHAR(255) DEFAULT NULL, wigth VARCHAR(255) DEFAULT NULL, id_product VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE products');
    }
}
