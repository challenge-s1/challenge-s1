<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230118113627 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE "user" ADD city VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE "user" ADD postalcode INT NOT NULL');
        $this->addSql('ALTER TABLE "user" ADD address VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE "user" ADD country VARCHAR(255) NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE "user" DROP city');
        $this->addSql('ALTER TABLE "user" DROP postalcode');
        $this->addSql('ALTER TABLE "user" DROP address');
        $this->addSql('ALTER TABLE "user" DROP country');
    }
}
