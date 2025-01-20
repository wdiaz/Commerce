<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250120223515 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('ALTER TABLE product_product_option DROP CONSTRAINT fk_6b933f384584665a');
        $this->addSql('ALTER TABLE product_product_option DROP CONSTRAINT fk_6b933f38c964abe2');
        $this->addSql('DROP TABLE product_product_option');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('CREATE TABLE product_product_option (product_id INT NOT NULL, product_option_id INT NOT NULL, PRIMARY KEY(product_id, product_option_id))');
        $this->addSql('CREATE INDEX idx_6b933f38c964abe2 ON product_product_option (product_option_id)');
        $this->addSql('CREATE INDEX idx_6b933f384584665a ON product_product_option (product_id)');
        $this->addSql('ALTER TABLE product_product_option ADD CONSTRAINT fk_6b933f384584665a FOREIGN KEY (product_id) REFERENCES products (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE product_product_option ADD CONSTRAINT fk_6b933f38c964abe2 FOREIGN KEY (product_option_id) REFERENCES product_option (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
    }
}
