<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230210042705 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE master_class ADD date DATE NOT NULL');
        $this->addSql('ALTER TABLE master_class ADD time TIME(0) WITHOUT TIME ZONE NOT NULL');
        $this->addSql('ALTER TABLE master_class ADD adress VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE master_class ADD city VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE master_class ADD postalcode INT NOT NULL');
        $this->addSql('ALTER TABLE master_class ADD country VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE master_class ADD created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL');
        $this->addSql('ALTER TABLE master_class ADD updated_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL');
        $this->addSql('COMMENT ON COLUMN master_class.created_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('COMMENT ON COLUMN master_class.updated_at IS \'(DC2Type:datetime_immutable)\'');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE master_class DROP date');
        $this->addSql('ALTER TABLE master_class DROP time');
        $this->addSql('ALTER TABLE master_class DROP adress');
        $this->addSql('ALTER TABLE master_class DROP city');
        $this->addSql('ALTER TABLE master_class DROP postalcode');
        $this->addSql('ALTER TABLE master_class DROP country');
        $this->addSql('ALTER TABLE master_class DROP created_at');
        $this->addSql('ALTER TABLE master_class DROP updated_at');
    }
}
