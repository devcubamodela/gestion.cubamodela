<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20221211223039 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE customers ADD first_name_biling VARCHAR(255) DEFAULT NULL, ADD last_name_biling VARCHAR(255) DEFAULT NULL, ADD address_1_biling VARCHAR(255) DEFAULT NULL, ADD company_biling VARCHAR(255) DEFAULT NULL, ADD address_2_biling VARCHAR(255) DEFAULT NULL, ADD city_biling VARCHAR(255) DEFAULT NULL, ADD state_biling VARCHAR(255) DEFAULT NULL, ADD postcode_biling VARCHAR(255) DEFAULT NULL, ADD country_biling VARCHAR(255) DEFAULT NULL, ADD email_biling VARCHAR(255) DEFAULT NULL, ADD phone_biling VARCHAR(255) DEFAULT NULL, ADD first_name_shipping VARCHAR(255) DEFAULT NULL, ADD last_name_shipping VARCHAR(255) DEFAULT NULL, ADD company_shipping VARCHAR(255) DEFAULT NULL, ADD address_1_shipping VARCHAR(255) DEFAULT NULL, ADD address_2_shipping VARCHAR(255) DEFAULT NULL, ADD city_shipping VARCHAR(255) DEFAULT NULL, ADD state_shipping VARCHAR(255) DEFAULT NULL, ADD postcode_shipping VARCHAR(255) DEFAULT NULL, ADD country_shipping VARCHAR(255) DEFAULT NULL, ADD is_paying_customer VARCHAR(255) DEFAULT NULL, ADD avatar_url VARCHAR(255) DEFAULT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE customers DROP first_name_biling, DROP last_name_biling, DROP address_1_biling, DROP company_biling, DROP address_2_biling, DROP city_biling, DROP state_biling, DROP postcode_biling, DROP country_biling, DROP email_biling, DROP phone_biling, DROP first_name_shipping, DROP last_name_shipping, DROP company_shipping, DROP address_1_shipping, DROP address_2_shipping, DROP city_shipping, DROP state_shipping, DROP postcode_shipping, DROP country_shipping, DROP is_paying_customer, DROP avatar_url');
       
    }
}
