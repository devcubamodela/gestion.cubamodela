<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230304165814 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE customer (id INT AUTO_INCREMENT NOT NULL, id_customer INT NOT NULL, date_created DATE DEFAULT NULL, date_created_gmt DATE DEFAULT NULL, date_modified DATE DEFAULT NULL, date_modified_gmt DATE DEFAULT NULL, email VARCHAR(255) DEFAULT NULL, first_name VARCHAR(255) DEFAULT NULL, last_name VARCHAR(255) DEFAULT NULL, role VARCHAR(255) DEFAULT NULL, username VARCHAR(255) DEFAULT NULL, billing_firs_name VARCHAR(255) DEFAULT NULL, billing_last_name VARCHAR(255) DEFAULT NULL, billing_company VARCHAR(255) DEFAULT NULL, billing_address_1 VARCHAR(255) DEFAULT NULL, billing_address_2 VARCHAR(255) DEFAULT NULL, billing_city VARCHAR(255) DEFAULT NULL, billing_state VARCHAR(255) DEFAULT NULL, billing_postcode VARCHAR(255) DEFAULT NULL, billing_country VARCHAR(255) DEFAULT NULL, billing_email VARCHAR(255) DEFAULT NULL, billing_phone VARCHAR(255) DEFAULT NULL, shipping_firs_name VARCHAR(255) DEFAULT NULL, shipping_last_name VARCHAR(255) DEFAULT NULL, shipping_company VARCHAR(255) DEFAULT NULL, shipping_address_1 VARCHAR(255) DEFAULT NULL, shipping_address_2 VARCHAR(255) DEFAULT NULL, shipping_city VARCHAR(255) DEFAULT NULL, shipping_state VARCHAR(255) DEFAULT NULL, shipping_postcode VARCHAR(255) DEFAULT NULL, shipping_country VARCHAR(255) DEFAULT NULL, is_paying_customer TINYINT(1) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE customer');
    }
}
