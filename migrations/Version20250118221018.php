<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250118221018 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('CREATE SEQUENCE product_variant_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE product_variant_option_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE product_variant (id INT NOT NULL, product_id INT DEFAULT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, updated_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, sku VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_209AA41D4584665A ON product_variant (product_id)');
        $this->addSql('COMMENT ON COLUMN product_variant.created_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('COMMENT ON COLUMN product_variant.updated_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('CREATE TABLE product_variant_option (id INT NOT NULL, product_variant_id INT DEFAULT NULL, product_option_id INT DEFAULT NULL, product_option_value_id INT DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_1CB5D94AA80EF684 ON product_variant_option (product_variant_id)');
        $this->addSql('CREATE INDEX IDX_1CB5D94AC964ABE2 ON product_variant_option (product_option_id)');
        $this->addSql('CREATE INDEX IDX_1CB5D94AEBDCCF9B ON product_variant_option (product_option_value_id)');
        $this->addSql('ALTER TABLE product_variant ADD CONSTRAINT FK_209AA41D4584665A FOREIGN KEY (product_id) REFERENCES products (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE product_variant_option ADD CONSTRAINT FK_1CB5D94AA80EF684 FOREIGN KEY (product_variant_id) REFERENCES product_variant (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE product_variant_option ADD CONSTRAINT FK_1CB5D94AC964ABE2 FOREIGN KEY (product_option_id) REFERENCES product_option (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE product_variant_option ADD CONSTRAINT FK_1CB5D94AEBDCCF9B FOREIGN KEY (product_option_value_id) REFERENCES product_option_value (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('DROP SEQUENCE product_variant_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE product_variant_option_id_seq CASCADE');
        $this->addSql('ALTER TABLE product_variant DROP CONSTRAINT FK_209AA41D4584665A');
        $this->addSql('ALTER TABLE product_variant_option DROP CONSTRAINT FK_1CB5D94AA80EF684');
        $this->addSql('ALTER TABLE product_variant_option DROP CONSTRAINT FK_1CB5D94AC964ABE2');
        $this->addSql('ALTER TABLE product_variant_option DROP CONSTRAINT FK_1CB5D94AEBDCCF9B');
        $this->addSql('DROP TABLE product_variant');
        $this->addSql('DROP TABLE product_variant_option');
    }
}
