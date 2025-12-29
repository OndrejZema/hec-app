<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20251229125920 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE broker_profile (id INT AUTO_INCREMENT NOT NULL, user_id INT NOT NULL, name VARCHAR(255) NOT NULL, description VARCHAR(255) DEFAULT NULL, purchase_profile_day JSON NOT NULL COMMENT \'(DC2Type:json)\', purchase_profile_week JSON NOT NULL COMMENT \'(DC2Type:json)\', purchase_profile_month JSON NOT NULL COMMENT \'(DC2Type:json)\', purchase_profile_year JSON NOT NULL COMMENT \'(DC2Type:json)\', sale_profile_day JSON NOT NULL COMMENT \'(DC2Type:json)\', sale_profile_week JSON NOT NULL COMMENT \'(DC2Type:json)\', sale_profile_month JSON NOT NULL COMMENT \'(DC2Type:json)\', sale_profile_year JSON NOT NULL COMMENT \'(DC2Type:json)\', INDEX IDX_3635A9F5A76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE broker_profile ADD CONSTRAINT FK_3635A9F5A76ED395 FOREIGN KEY (user_id) REFERENCES `user` (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE broker_profile DROP FOREIGN KEY FK_3635A9F5A76ED395');
        $this->addSql('DROP TABLE broker_profile');
    }
}
