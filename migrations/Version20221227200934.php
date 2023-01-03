<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20221227200934 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE customers (id INT AUTO_INCREMENT NOT NULL, id_costumer VARCHAR(255) DEFAULT NULL, date_created VARCHAR(255) DEFAULT NULL, date_created_gmt VARCHAR(255) DEFAULT NULL, email VARCHAR(255) DEFAULT NULL, first_name VARCHAR(255) DEFAULT NULL, last_name VARCHAR(255) DEFAULT NULL, role VARCHAR(255) DEFAULT NULL, username VARCHAR(255) DEFAULT NULL, first_name_biling VARCHAR(255) DEFAULT NULL, last_name_biling VARCHAR(255) DEFAULT NULL, address_1_biling VARCHAR(255) DEFAULT NULL, company_biling VARCHAR(255) DEFAULT NULL, address_2_biling VARCHAR(255) DEFAULT NULL, city_biling VARCHAR(255) DEFAULT NULL, state_biling VARCHAR(255) DEFAULT NULL, postcode_biling VARCHAR(255) DEFAULT NULL, country_biling VARCHAR(255) DEFAULT NULL, email_biling VARCHAR(255) DEFAULT NULL, phone_biling VARCHAR(255) DEFAULT NULL, first_name_shipping VARCHAR(255) DEFAULT NULL, last_name_shipping VARCHAR(255) DEFAULT NULL, company_shipping VARCHAR(255) DEFAULT NULL, address_1_shipping VARCHAR(255) DEFAULT NULL, address_2_shipping VARCHAR(255) DEFAULT NULL, city_shipping VARCHAR(255) DEFAULT NULL, state_shipping VARCHAR(255) DEFAULT NULL, postcode_shipping VARCHAR(255) DEFAULT NULL, country_shipping VARCHAR(255) DEFAULT NULL, is_paying_customer VARCHAR(255) DEFAULT NULL, avatar_url VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE products (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) DEFAULT NULL, sku VARCHAR(255) DEFAULT NULL, amount VARCHAR(255) DEFAULT NULL, picture VARCHAR(255) DEFAULT NULL, brand VARCHAR(255) DEFAULT NULL, date VARCHAR(255) DEFAULT NULL, slug VARCHAR(255) DEFAULT NULL, permalink VARCHAR(255) DEFAULT NULL, date_created VARCHAR(255) DEFAULT NULL, date_created_gmt VARCHAR(255) DEFAULT NULL, date_modified VARCHAR(255) DEFAULT NULL, date_modified_gmt VARCHAR(255) DEFAULT NULL, type VARCHAR(255) DEFAULT NULL, status VARCHAR(255) DEFAULT NULL, featured VARCHAR(255) DEFAULT NULL, catalog_visibility VARCHAR(255) DEFAULT NULL, description VARCHAR(255) DEFAULT NULL, short_description VARCHAR(255) DEFAULT NULL, price VARCHAR(255) DEFAULT NULL, regular_price VARCHAR(255) DEFAULT NULL, date_on_sale_from VARCHAR(255) DEFAULT NULL, date_on_sale_from_gmt VARCHAR(255) DEFAULT NULL, date_on_sale_to VARCHAR(255) DEFAULT NULL, date_on_sale_to_gmt VARCHAR(255) DEFAULT NULL, on_sale VARCHAR(255) DEFAULT NULL, total_sales VARCHAR(255) DEFAULT NULL, stock_quantity VARCHAR(255) DEFAULT NULL, stock_status VARCHAR(255) DEFAULT NULL, backorders VARCHAR(255) DEFAULT NULL, backorders_allowed VARCHAR(255) DEFAULT NULL, sold_individuality VARCHAR(255) DEFAULT NULL, wigth VARCHAR(255) DEFAULT NULL, id_product VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL, available_at DATETIME NOT NULL, delivered_at DATETIME DEFAULT NULL, INDEX IDX_75EA56E0FB7336F0 (queue_name), INDEX IDX_75EA56E0E3BD61CE (available_at), INDEX IDX_75EA56E016BA31DB (delivered_at), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE customers');
        $this->addSql('DROP TABLE products');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
