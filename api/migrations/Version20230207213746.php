<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230207213746 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SEQUENCE cart_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE category_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE master_class_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE ordered_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE pastrie_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE reservation_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE "user_id_seq" INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE voucher_discount_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE cart (id INT NOT NULL, client_id INT NOT NULL, cake_id INT DEFAULT NULL, master_class_id INT DEFAULT NULL, quantity INT NOT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, updated_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_BA388B719EB6921 ON cart (client_id)');
        $this->addSql('CREATE INDEX IDX_BA388B79F8008B6 ON cart (cake_id)');
        $this->addSql('CREATE INDEX IDX_BA388B7A9B5C597 ON cart (master_class_id)');
        $this->addSql('COMMENT ON COLUMN cart.created_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('COMMENT ON COLUMN cart.updated_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('CREATE TABLE category (id INT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE master_class (id INT NOT NULL, owner_id INT NOT NULL, title VARCHAR(255) NOT NULL, description TEXT NOT NULL, price DOUBLE PRECISION NOT NULL, max_number INT NOT NULL, is_canceled BOOLEAN DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_D90E754E7E3C61F9 ON master_class (owner_id)');
        $this->addSql('CREATE TABLE ordered (id INT NOT NULL, pastrie_id INT NOT NULL, owner_id INT NOT NULL, quantity INT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_C3121F992313B8A7 ON ordered (pastrie_id)');
        $this->addSql('CREATE INDEX IDX_C3121F997E3C61F9 ON ordered (owner_id)');
        $this->addSql('CREATE TABLE pastrie (id INT NOT NULL, owner_id INT NOT NULL, category_id INT NOT NULL, name VARCHAR(255) NOT NULL, description TEXT DEFAULT NULL, price DOUBLE PRECISION NOT NULL, picture VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_361187797E3C61F9 ON pastrie (owner_id)');
        $this->addSql('CREATE INDEX IDX_3611877912469DE2 ON pastrie (category_id)');
        $this->addSql('CREATE TABLE reservation (id INT NOT NULL, master_class_id INT NOT NULL, user_id_id INT NOT NULL, nb_places INT NOT NULL, price DOUBLE PRECISION NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_42C84955A9B5C597 ON reservation (master_class_id)');
        $this->addSql('CREATE INDEX IDX_42C849559D86650F ON reservation (user_id_id)');
        $this->addSql('CREATE TABLE "user" (id INT NOT NULL, email VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, token VARCHAR(255) DEFAULT NULL, first_name VARCHAR(255) NOT NULL, last_name VARCHAR(255) NOT NULL, city VARCHAR(255) NOT NULL, postalcode INT NOT NULL, address VARCHAR(255) NOT NULL, country VARCHAR(255) NOT NULL, is_active BOOLEAN DEFAULT false, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_8D93D649E7927C74 ON "user" (email)');
        $this->addSql('CREATE TABLE voucher_discount (id INT NOT NULL, owner_id INT NOT NULL, price DOUBLE PRECISION NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_7F47EC877E3C61F9 ON voucher_discount (owner_id)');
        $this->addSql('ALTER TABLE cart ADD CONSTRAINT FK_BA388B719EB6921 FOREIGN KEY (client_id) REFERENCES "user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE cart ADD CONSTRAINT FK_BA388B79F8008B6 FOREIGN KEY (cake_id) REFERENCES pastrie (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE cart ADD CONSTRAINT FK_BA388B7A9B5C597 FOREIGN KEY (master_class_id) REFERENCES master_class (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE master_class ADD CONSTRAINT FK_D90E754E7E3C61F9 FOREIGN KEY (owner_id) REFERENCES "user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE ordered ADD CONSTRAINT FK_C3121F992313B8A7 FOREIGN KEY (pastrie_id) REFERENCES pastrie (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE ordered ADD CONSTRAINT FK_C3121F997E3C61F9 FOREIGN KEY (owner_id) REFERENCES "user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE pastrie ADD CONSTRAINT FK_361187797E3C61F9 FOREIGN KEY (owner_id) REFERENCES "user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE pastrie ADD CONSTRAINT FK_3611877912469DE2 FOREIGN KEY (category_id) REFERENCES category (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE reservation ADD CONSTRAINT FK_42C84955A9B5C597 FOREIGN KEY (master_class_id) REFERENCES master_class (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE reservation ADD CONSTRAINT FK_42C849559D86650F FOREIGN KEY (user_id_id) REFERENCES "user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE voucher_discount ADD CONSTRAINT FK_7F47EC877E3C61F9 FOREIGN KEY (owner_id) REFERENCES "user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('DROP SEQUENCE cart_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE category_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE master_class_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE ordered_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE pastrie_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE reservation_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE "user_id_seq" CASCADE');
        $this->addSql('DROP SEQUENCE voucher_discount_id_seq CASCADE');
        $this->addSql('ALTER TABLE cart DROP CONSTRAINT FK_BA388B719EB6921');
        $this->addSql('ALTER TABLE cart DROP CONSTRAINT FK_BA388B79F8008B6');
        $this->addSql('ALTER TABLE cart DROP CONSTRAINT FK_BA388B7A9B5C597');
        $this->addSql('ALTER TABLE master_class DROP CONSTRAINT FK_D90E754E7E3C61F9');
        $this->addSql('ALTER TABLE ordered DROP CONSTRAINT FK_C3121F992313B8A7');
        $this->addSql('ALTER TABLE ordered DROP CONSTRAINT FK_C3121F997E3C61F9');
        $this->addSql('ALTER TABLE pastrie DROP CONSTRAINT FK_361187797E3C61F9');
        $this->addSql('ALTER TABLE pastrie DROP CONSTRAINT FK_3611877912469DE2');
        $this->addSql('ALTER TABLE reservation DROP CONSTRAINT FK_42C84955A9B5C597');
        $this->addSql('ALTER TABLE reservation DROP CONSTRAINT FK_42C849559D86650F');
        $this->addSql('ALTER TABLE voucher_discount DROP CONSTRAINT FK_7F47EC877E3C61F9');
        $this->addSql('DROP TABLE cart');
        $this->addSql('DROP TABLE category');
        $this->addSql('DROP TABLE master_class');
        $this->addSql('DROP TABLE ordered');
        $this->addSql('DROP TABLE pastrie');
        $this->addSql('DROP TABLE reservation');
        $this->addSql('DROP TABLE "user"');
        $this->addSql('DROP TABLE voucher_discount');
    }
}
