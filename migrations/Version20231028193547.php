<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231028193547 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE economia CHANGE id_producto id_producto INT DEFAULT NULL, CHANGE id_orden id_orden INT DEFAULT NULL, CHANGE id_proveedor id_proveedor INT DEFAULT NULL, CHANGE pagado pagado TINYINT(1) DEFAULT NULL, CHANGE fecha_pagado fecha_pagado DATE DEFAULT NULL, CHANGE traza_pagado traza_pagado VARCHAR(255) DEFAULT NULL, CHANGE cantidad_pagado cantidad_pagado INT DEFAULT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE economia CHANGE id_producto id_producto INT NOT NULL, CHANGE id_orden id_orden INT NOT NULL, CHANGE id_proveedor id_proveedor INT NOT NULL, CHANGE pagado pagado TINYINT(1) NOT NULL, CHANGE fecha_pagado fecha_pagado DATE NOT NULL, CHANGE traza_pagado traza_pagado VARCHAR(255) NOT NULL, CHANGE cantidad_pagado cantidad_pagado INT NOT NULL');
    }
}
