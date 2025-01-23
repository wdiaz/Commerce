<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250104140546 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('CREATE SEQUENCE product_option_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE product_option (id INT NOT NULL, name VARCHAR(255) NOT NULL, option_type VARCHAR(255) NOT NULL, attribute_name VARCHAR(255) NOT NULL, label VARCHAR(255) NOT NULL, is_required BOOLEAN NOT NULL, display_order INT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE product_product_option (product_id INT NOT NULL, product_option_id INT NOT NULL, PRIMARY KEY(product_id, product_option_id))');
        $this->addSql('CREATE INDEX IDX_6B933F384584665A ON product_product_option (product_id)');
        $this->addSql('CREATE INDEX IDX_6B933F38C964ABE2 ON product_product_option (product_option_id)');
        $this->addSql('ALTER TABLE product_product_option ADD CONSTRAINT FK_6B933F384584665A FOREIGN KEY (product_id) REFERENCES products (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE product_product_option ADD CONSTRAINT FK_6B933F38C964ABE2 FOREIGN KEY (product_option_id) REFERENCES product_option (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('DROP SEQUENCE product_option_id_seq CASCADE');
        $this->addSql('ALTER TABLE product_product_option DROP CONSTRAINT FK_6B933F384584665A');
        $this->addSql('ALTER TABLE product_product_option DROP CONSTRAINT FK_6B933F38C964ABE2');
        $this->addSql('DROP TABLE product_option');
        $this->addSql('DROP TABLE product_product_option');
    }
}
