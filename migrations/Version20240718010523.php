<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240718010523 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('ALTER TABLE products ADD merchant_id INT NOT NULL');
        $this->addSql('ALTER TABLE products ADD CONSTRAINT FK_B3BA5A5A6796D554 FOREIGN KEY (merchant_id) REFERENCES merchant (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX IDX_B3BA5A5A6796D554 ON products (merchant_id)');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('ALTER TABLE products DROP CONSTRAINT FK_B3BA5A5A6796D554');
        $this->addSql('DROP INDEX IDX_B3BA5A5A6796D554');
        $this->addSql('ALTER TABLE products DROP merchant_id');
        $this->addSql('ALTER TABLE cart ALTER uuid TYPE VARCHAR(255)');
    }
}
