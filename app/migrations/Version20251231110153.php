<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20251231110153 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE house_broker_profile (id INT AUTO_INCREMENT NOT NULL, house_id INT DEFAULT NULL, broker_profile_id INT DEFAULT NULL, user_id INT NOT NULL, is_active TINYINT(1) NOT NULL, INDEX IDX_F12276846BB74515 (house_id), INDEX IDX_F1227684FC38B7BE (broker_profile_id), INDEX IDX_F1227684A76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE house_broker_profile ADD CONSTRAINT FK_F12276846BB74515 FOREIGN KEY (house_id) REFERENCES house (id)');
        $this->addSql('ALTER TABLE house_broker_profile ADD CONSTRAINT FK_F1227684FC38B7BE FOREIGN KEY (broker_profile_id) REFERENCES broker_profile (id)');
        $this->addSql('ALTER TABLE house_broker_profile ADD CONSTRAINT FK_F1227684A76ED395 FOREIGN KEY (user_id) REFERENCES `user` (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE house_broker_profile DROP FOREIGN KEY FK_F12276846BB74515');
        $this->addSql('ALTER TABLE house_broker_profile DROP FOREIGN KEY FK_F1227684FC38B7BE');
        $this->addSql('ALTER TABLE house_broker_profile DROP FOREIGN KEY FK_F1227684A76ED395');
        $this->addSql('DROP TABLE house_broker_profile');
    }
}
