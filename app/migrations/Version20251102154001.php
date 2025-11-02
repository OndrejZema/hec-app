<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20251102154001 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE house_visit (id INT AUTO_INCREMENT NOT NULL, user_id INT NOT NULL, house_id INT NOT NULL, visited_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_989D4EC1A76ED395 (user_id), INDEX IDX_989D4EC16BB74515 (house_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE house_visit ADD CONSTRAINT FK_989D4EC1A76ED395 FOREIGN KEY (user_id) REFERENCES `user` (id)');
        $this->addSql('ALTER TABLE house_visit ADD CONSTRAINT FK_989D4EC16BB74515 FOREIGN KEY (house_id) REFERENCES house (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE house_visit DROP FOREIGN KEY FK_989D4EC1A76ED395');
        $this->addSql('ALTER TABLE house_visit DROP FOREIGN KEY FK_989D4EC16BB74515');
        $this->addSql('DROP TABLE house_visit');
    }
}
