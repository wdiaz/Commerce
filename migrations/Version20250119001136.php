<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250119001136 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('ALTER TABLE product_variant ADD quantity INT DEFAULT NULL');
        $this->addSql('ALTER TABLE product_variant ADD price NUMERIC(5, 2) DEFAULT NULL');
        $this->addSql('ALTER TABLE product_variant ADD main_image VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE product_variant ADD thumbnail VARCHAR(255) DEFAULT NULL');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('ALTER TABLE product_variant DROP quantity');
        $this->addSql('ALTER TABLE product_variant DROP price');
        $this->addSql('ALTER TABLE product_variant DROP main_image');
        $this->addSql('ALTER TABLE product_variant DROP thumbnail');
    }
}
