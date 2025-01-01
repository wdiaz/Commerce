<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20241231033116 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('CREATE SEQUENCE product_variant_option_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE product_variant_option_values_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE product_variant_option (id INT NOT NULL, product_variant_id INT DEFAULT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, updated_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, name VARCHAR(255) NOT NULL, option_type VARCHAR(255) NOT NULL, is_required BOOLEAN NOT NULL, display_order INT DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_1CB5D94AA80EF684 ON product_variant_option (product_variant_id)');
        $this->addSql('COMMENT ON COLUMN product_variant_option.created_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('COMMENT ON COLUMN product_variant_option.updated_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('CREATE TABLE product_variant_option_values (id INT NOT NULL, product_variant_option_id INT DEFAULT NULL, option_value VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_D436A3F6F0BDF46F ON product_variant_option_values (product_variant_option_id)');
        $this->addSql('ALTER TABLE product_variant_option ADD CONSTRAINT FK_1CB5D94AA80EF684 FOREIGN KEY (product_variant_id) REFERENCES product_variant (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE product_variant_option_values ADD CONSTRAINT FK_D436A3F6F0BDF46F FOREIGN KEY (product_variant_option_id) REFERENCES product_variant_option (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('DROP SEQUENCE product_variant_option_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE product_variant_option_values_id_seq CASCADE');
        $this->addSql('ALTER TABLE product_variant_option DROP CONSTRAINT FK_1CB5D94AA80EF684');
        $this->addSql('ALTER TABLE product_variant_option_values DROP CONSTRAINT FK_D436A3F6F0BDF46F');
        $this->addSql('DROP TABLE product_variant_option');
        $this->addSql('DROP TABLE product_variant_option_values');
    }
}
