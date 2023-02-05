<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230205201303 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SEQUENCE cart_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE cart (id INT NOT NULL, client_id INT NOT NULL, cake_id INT DEFAULT NULL, master_class_id INT DEFAULT NULL, quantity INT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_BA388B719EB6921 ON cart (client_id)');
        $this->addSql('CREATE INDEX IDX_BA388B79F8008B6 ON cart (cake_id)');
        $this->addSql('CREATE INDEX IDX_BA388B7A9B5C597 ON cart (master_class_id)');
        $this->addSql('ALTER TABLE cart ADD CONSTRAINT FK_BA388B719EB6921 FOREIGN KEY (client_id) REFERENCES "user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE cart ADD CONSTRAINT FK_BA388B79F8008B6 FOREIGN KEY (cake_id) REFERENCES pastrie (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE cart ADD CONSTRAINT FK_BA388B7A9B5C597 FOREIGN KEY (master_class_id) REFERENCES master_class (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('DROP SEQUENCE cart_id_seq CASCADE');
        $this->addSql('ALTER TABLE cart DROP CONSTRAINT FK_BA388B719EB6921');
        $this->addSql('ALTER TABLE cart DROP CONSTRAINT FK_BA388B79F8008B6');
        $this->addSql('ALTER TABLE cart DROP CONSTRAINT FK_BA388B7A9B5C597');
        $this->addSql('DROP TABLE cart');
    }
}
