<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20251102154836 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE house ADD created_at DATETIME NOT NULL, ADD updated_at DATETIME NOT NULL');
        $this->addSql('ALTER TABLE house_visit ADD created_at DATETIME NOT NULL, ADD updated_at DATETIME NOT NULL, DROP visited_at');
        $this->addSql('ALTER TABLE reset_password_request ADD created_at DATETIME NOT NULL, ADD updated_at DATETIME NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE house DROP created_at, DROP updated_at');
        $this->addSql('ALTER TABLE reset_password_request DROP created_at, DROP updated_at');
        $this->addSql('ALTER TABLE house_visit ADD visited_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', DROP created_at, DROP updated_at');
    }
}
