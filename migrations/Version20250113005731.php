<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250113005731 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('CREATE SEQUENCE product_option_value_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE product_option_value (id INT NOT NULL, product_option_id INT DEFAULT NULL, attribute_value VARCHAR(255) NOT NULL, display_order INT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_A938C737C964ABE2 ON product_option_value (product_option_id)');
        $this->addSql('ALTER TABLE product_option_value ADD CONSTRAINT FK_A938C737C964ABE2 FOREIGN KEY (product_option_id) REFERENCES product_option (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('DROP SEQUENCE product_option_value_id_seq CASCADE');
        $this->addSql('ALTER TABLE product_option_value DROP CONSTRAINT FK_A938C737C964ABE2');
        $this->addSql('DROP TABLE product_option_value');
    }
}
