<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230116224040 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SEQUENCE category_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE master_class_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE ordered_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE pastrie_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE reservation_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE category (id INT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE master_class (id INT NOT NULL, owner_id INT NOT NULL, title VARCHAR(255) NOT NULL, description TEXT NOT NULL, price DOUBLE PRECISION NOT NULL, max_number INT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_D90E754E7E3C61F9 ON master_class (owner_id)');
        $this->addSql('CREATE TABLE ordered (id INT NOT NULL, pastrie_id INT NOT NULL, owner_id INT NOT NULL, quantity INT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_C3121F992313B8A7 ON ordered (pastrie_id)');
        $this->addSql('CREATE INDEX IDX_C3121F997E3C61F9 ON ordered (owner_id)');
        $this->addSql('CREATE TABLE pastrie (id INT NOT NULL, owner_id INT NOT NULL, category_id INT NOT NULL, name VARCHAR(255) NOT NULL, description TEXT DEFAULT NULL, price DOUBLE PRECISION NOT NULL, picture VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_361187797E3C61F9 ON pastrie (owner_id)');
        $this->addSql('CREATE INDEX IDX_3611877912469DE2 ON pastrie (category_id)');
        $this->addSql('CREATE TABLE reservation (id INT NOT NULL, master_class_id INT NOT NULL, user_id_id INT NOT NULL, nb_places INT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_42C84955A9B5C597 ON reservation (master_class_id)');
        $this->addSql('CREATE INDEX IDX_42C849559D86650F ON reservation (user_id_id)');
        $this->addSql('ALTER TABLE master_class ADD CONSTRAINT FK_D90E754E7E3C61F9 FOREIGN KEY (owner_id) REFERENCES "user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE ordered ADD CONSTRAINT FK_C3121F992313B8A7 FOREIGN KEY (pastrie_id) REFERENCES pastrie (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE ordered ADD CONSTRAINT FK_C3121F997E3C61F9 FOREIGN KEY (owner_id) REFERENCES "user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE pastrie ADD CONSTRAINT FK_361187797E3C61F9 FOREIGN KEY (owner_id) REFERENCES "user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE pastrie ADD CONSTRAINT FK_3611877912469DE2 FOREIGN KEY (category_id) REFERENCES category (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE reservation ADD CONSTRAINT FK_42C84955A9B5C597 FOREIGN KEY (master_class_id) REFERENCES master_class (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE reservation ADD CONSTRAINT FK_42C849559D86650F FOREIGN KEY (user_id_id) REFERENCES "user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('DROP SEQUENCE category_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE master_class_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE ordered_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE pastrie_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE reservation_id_seq CASCADE');
        $this->addSql('ALTER TABLE master_class DROP CONSTRAINT FK_D90E754E7E3C61F9');
        $this->addSql('ALTER TABLE ordered DROP CONSTRAINT FK_C3121F992313B8A7');
        $this->addSql('ALTER TABLE ordered DROP CONSTRAINT FK_C3121F997E3C61F9');
        $this->addSql('ALTER TABLE pastrie DROP CONSTRAINT FK_361187797E3C61F9');
        $this->addSql('ALTER TABLE pastrie DROP CONSTRAINT FK_3611877912469DE2');
        $this->addSql('ALTER TABLE reservation DROP CONSTRAINT FK_42C84955A9B5C597');
        $this->addSql('ALTER TABLE reservation DROP CONSTRAINT FK_42C849559D86650F');
        $this->addSql('DROP TABLE category');
        $this->addSql('DROP TABLE master_class');
        $this->addSql('DROP TABLE ordered');
        $this->addSql('DROP TABLE pastrie');
        $this->addSql('DROP TABLE reservation');
    }
}
