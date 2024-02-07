<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240119033700 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SEQUENCE variant_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE variant_option_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE variant (id INT NOT NULL, product_id INT NOT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, updated_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_F143BFAD4584665A ON variant (product_id)');
        $this->addSql('COMMENT ON COLUMN variant.created_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('COMMENT ON COLUMN variant.updated_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('CREATE TABLE variant_option (id INT NOT NULL, variant_id INT NOT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, updated_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, name VARCHAR(255) NOT NULL, value VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_4FDCA7663B69A9AF ON variant_option (variant_id)');
        $this->addSql('COMMENT ON COLUMN variant_option.created_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('COMMENT ON COLUMN variant_option.updated_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('ALTER TABLE variant ADD CONSTRAINT FK_F143BFAD4584665A FOREIGN KEY (product_id) REFERENCES products (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE variant_option ADD CONSTRAINT FK_4FDCA7663B69A9AF FOREIGN KEY (variant_id) REFERENCES variant (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('DROP SEQUENCE variant_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE variant_option_id_seq CASCADE');
        $this->addSql('ALTER TABLE variant DROP CONSTRAINT FK_F143BFAD4584665A');
        $this->addSql('ALTER TABLE variant_option DROP CONSTRAINT FK_4FDCA7663B69A9AF');
        $this->addSql('DROP TABLE variant');
        $this->addSql('DROP TABLE variant_option');
    }
}
