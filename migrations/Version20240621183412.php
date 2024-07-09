<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240621183412 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('ALTER TABLE cart_item ADD merchant_id INT NOT NULL');
        $this->addSql('ALTER TABLE cart_item ADD CONSTRAINT FK_F0FE25276796D554 FOREIGN KEY (merchant_id) REFERENCES merchant (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX IDX_F0FE25276796D554 ON cart_item (merchant_id)');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('ALTER TABLE cart_item DROP CONSTRAINT FK_F0FE25276796D554');
        $this->addSql('DROP INDEX IDX_F0FE25276796D554');
        $this->addSql('ALTER TABLE cart_item DROP merchant_id');
    }
}
