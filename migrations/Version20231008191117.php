<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231008191117 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE claves (id INT AUTO_INCREMENT NOT NULL, ck VARCHAR(255) DEFAULT NULL, cs VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE customer (id INT AUTO_INCREMENT NOT NULL, id_customer INT NOT NULL, date_created DATE DEFAULT NULL, date_created_gmt DATE DEFAULT NULL, date_modified DATE DEFAULT NULL, date_modified_gmt DATE DEFAULT NULL, email VARCHAR(255) DEFAULT NULL, first_name VARCHAR(255) DEFAULT NULL, last_name VARCHAR(255) DEFAULT NULL, role VARCHAR(255) DEFAULT NULL, username VARCHAR(255) DEFAULT NULL, billing_firs_name VARCHAR(255) DEFAULT NULL, billing_last_name VARCHAR(255) DEFAULT NULL, billing_company VARCHAR(255) DEFAULT NULL, billing_address_1 VARCHAR(255) DEFAULT NULL, billing_address_2 VARCHAR(255) DEFAULT NULL, billing_city VARCHAR(255) DEFAULT NULL, billing_state VARCHAR(255) DEFAULT NULL, billing_postcode VARCHAR(255) DEFAULT NULL, billing_country VARCHAR(255) DEFAULT NULL, billing_email VARCHAR(255) DEFAULT NULL, billing_phone VARCHAR(255) DEFAULT NULL, shipping_firs_name VARCHAR(255) DEFAULT NULL, shipping_last_name VARCHAR(255) DEFAULT NULL, shipping_company VARCHAR(255) DEFAULT NULL, shipping_address_1 VARCHAR(255) DEFAULT NULL, shipping_address_2 VARCHAR(255) DEFAULT NULL, shipping_city VARCHAR(255) DEFAULT NULL, shipping_state VARCHAR(255) DEFAULT NULL, shipping_postcode VARCHAR(255) DEFAULT NULL, shipping_country VARCHAR(255) DEFAULT NULL, is_paying_customer TINYINT(1) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE customers (id INT AUTO_INCREMENT NOT NULL, id_costumer VARCHAR(255) DEFAULT NULL, date_created VARCHAR(255) DEFAULT NULL, date_created_gmt VARCHAR(255) DEFAULT NULL, email VARCHAR(255) DEFAULT NULL, first_name VARCHAR(255) DEFAULT NULL, last_name VARCHAR(255) DEFAULT NULL, role VARCHAR(255) DEFAULT NULL, username VARCHAR(255) DEFAULT NULL, first_name_biling VARCHAR(255) DEFAULT NULL, last_name_biling VARCHAR(255) DEFAULT NULL, address_1_biling VARCHAR(255) DEFAULT NULL, company_biling VARCHAR(255) DEFAULT NULL, address_2_biling VARCHAR(255) DEFAULT NULL, city_biling VARCHAR(255) DEFAULT NULL, state_biling VARCHAR(255) DEFAULT NULL, postcode_biling VARCHAR(255) DEFAULT NULL, country_biling VARCHAR(255) DEFAULT NULL, email_biling VARCHAR(255) DEFAULT NULL, phone_biling VARCHAR(255) DEFAULT NULL, first_name_shipping VARCHAR(255) DEFAULT NULL, last_name_shipping VARCHAR(255) DEFAULT NULL, company_shipping VARCHAR(255) DEFAULT NULL, address_1_shipping VARCHAR(255) DEFAULT NULL, address_2_shipping VARCHAR(255) DEFAULT NULL, city_shipping VARCHAR(255) DEFAULT NULL, state_shipping VARCHAR(255) DEFAULT NULL, postcode_shipping VARCHAR(255) DEFAULT NULL, country_shipping VARCHAR(255) DEFAULT NULL, is_paying_customer VARCHAR(255) DEFAULT NULL, avatar_url VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE orders (id INT AUTO_INCREMENT NOT NULL, order_id INT DEFAULT NULL, parent_id INT DEFAULT NULL, number VARCHAR(255) DEFAULT NULL, order_key VARCHAR(255) DEFAULT NULL, created_via VARCHAR(255) DEFAULT NULL, version VARCHAR(255) DEFAULT NULL, status VARCHAR(255) DEFAULT NULL, currency VARCHAR(255) DEFAULT NULL, date_created DATETIME DEFAULT NULL, date_modified DATETIME DEFAULT NULL, discount_total DOUBLE PRECISION DEFAULT NULL, discount_tax DOUBLE PRECISION DEFAULT NULL, shipping_total DOUBLE PRECISION DEFAULT NULL, shipping_tax DOUBLE PRECISION DEFAULT NULL, cart_tax DOUBLE PRECISION DEFAULT NULL, total DOUBLE PRECISION DEFAULT NULL, prices_include_tax DOUBLE PRECISION DEFAULT NULL, customer_id INT DEFAULT NULL, customer_ip_address VARCHAR(255) DEFAULT NULL, customer_user_agent LONGTEXT DEFAULT NULL, customer_note LONGTEXT DEFAULT NULL, billing_first_name VARCHAR(255) DEFAULT NULL, billing_last_name VARCHAR(255) DEFAULT NULL, billing_address_1 VARCHAR(255) DEFAULT NULL, billing_email VARCHAR(255) DEFAULT NULL, billing_phone VARCHAR(255) DEFAULT NULL, shipping_first_name VARCHAR(255) DEFAULT NULL, shipping_last_name VARCHAR(255) DEFAULT NULL, shipping_address_1 VARCHAR(255) DEFAULT NULL, payment_method VARCHAR(255) DEFAULT NULL, payment_method_title VARCHAR(255) DEFAULT NULL, date_paid DATETIME DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE orders_products (id INT AUTO_INCREMENT NOT NULL, id_order INT DEFAULT NULL, id_product INT DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE product_variation (id INT AUTO_INCREMENT NOT NULL, id_variation VARCHAR(255) DEFAULT NULL, date_created VARCHAR(255) DEFAULT NULL, description LONGTEXT DEFAULT NULL, sku VARCHAR(255) DEFAULT NULL, price VARCHAR(255) DEFAULT NULL, regular_price VARCHAR(255) DEFAULT NULL, sale_price VARCHAR(255) DEFAULT NULL, status VARCHAR(255) DEFAULT NULL, stock_status VARCHAR(255) DEFAULT NULL, id_product VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE products (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) DEFAULT NULL, sku VARCHAR(255) DEFAULT NULL, amount VARCHAR(255) DEFAULT NULL, picture VARCHAR(255) DEFAULT NULL, brand VARCHAR(255) DEFAULT NULL, date DATE DEFAULT NULL, slug VARCHAR(255) DEFAULT NULL, permalink VARCHAR(255) DEFAULT NULL, date_created DATE DEFAULT NULL, date_created_gmt DATE DEFAULT NULL, date_modified DATE DEFAULT NULL, date_modified_gmt DATE DEFAULT NULL, type VARCHAR(255) DEFAULT NULL, status VARCHAR(255) DEFAULT NULL, featured VARCHAR(255) DEFAULT NULL, catalog_visibility VARCHAR(255) DEFAULT NULL, price VARCHAR(255) DEFAULT NULL, regular_price VARCHAR(255) DEFAULT NULL, date_on_sale_from VARCHAR(255) DEFAULT NULL, date_on_sale_from_gmt VARCHAR(255) DEFAULT NULL, date_on_sale_to VARCHAR(255) DEFAULT NULL, date_on_sale_to_gmt VARCHAR(255) DEFAULT NULL, on_sale VARCHAR(255) DEFAULT NULL, total_sales VARCHAR(255) DEFAULT NULL, stock_quantity VARCHAR(255) DEFAULT NULL, stock_status VARCHAR(255) DEFAULT NULL, backorders VARCHAR(255) DEFAULT NULL, backorders_allowed VARCHAR(255) DEFAULT NULL, sold_individuality VARCHAR(255) DEFAULT NULL, wigth VARCHAR(255) DEFAULT NULL, id_product VARCHAR(255) DEFAULT NULL, description LONGTEXT DEFAULT NULL, short_description LONGTEXT DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE provider (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, codigo VARCHAR(255) DEFAULT NULL, id_products LONGTEXT DEFAULT NULL COMMENT \'(DC2Type:array)\', id_proveedor VARCHAR(255) NOT NULL, email VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE provider_product (id INT AUTO_INCREMENT NOT NULL, nomb_provider VARCHAR(255) DEFAULT NULL, id_product VARCHAR(255) DEFAULT NULL, cost VARCHAR(255) DEFAULT NULL, id_prvider VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE rols (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, is_verified TINYINT(1) NOT NULL, nombre VARCHAR(255) DEFAULT NULL, apellidos VARCHAR(255) DEFAULT NULL, telefono INT DEFAULT NULL, marca VARCHAR(255) DEFAULT NULL, avatar VARCHAR(255) DEFAULT NULL, UNIQUE INDEX UNIQ_8D93D649E7927C74 (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', available_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', delivered_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_75EA56E0FB7336F0 (queue_name), INDEX IDX_75EA56E0E3BD61CE (available_at), INDEX IDX_75EA56E016BA31DB (delivered_at), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE claves');
        $this->addSql('DROP TABLE customer');
        $this->addSql('DROP TABLE customers');
        $this->addSql('DROP TABLE orders');
        $this->addSql('DROP TABLE orders_products');
        $this->addSql('DROP TABLE product_variation');
        $this->addSql('DROP TABLE products');
        $this->addSql('DROP TABLE provider');
        $this->addSql('DROP TABLE provider_product');
        $this->addSql('DROP TABLE rols');
        $this->addSql('DROP TABLE user');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
