<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20251122081333 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE consumption_profile (id INT AUTO_INCREMENT NOT NULL, user_id INT NOT NULL, house_id INT NOT NULL, name VARCHAR(255) NOT NULL, description VARCHAR(255) DEFAULT NULL, type VARCHAR(255) NOT NULL, consumption_index SMALLINT NOT NULL, profile_day JSON NOT NULL COMMENT \'(DC2Type:json)\', profile_week JSON NOT NULL COMMENT \'(DC2Type:json)\', profile_month JSON NOT NULL COMMENT \'(DC2Type:json)\', profile_year JSON NOT NULL COMMENT \'(DC2Type:json)\', INDEX IDX_5BA47586A76ED395 (user_id), INDEX IDX_5BA475866BB74515 (house_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE house_consumption_profile (id INT AUTO_INCREMENT NOT NULL, user_id INT NOT NULL, house_id INT NOT NULL, consumption_profile_id INT NOT NULL, INDEX IDX_7CF3E14AA76ED395 (user_id), INDEX IDX_7CF3E14A6BB74515 (house_id), INDEX IDX_7CF3E14AA481B (consumption_profile_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE house_performance_profile (id INT AUTO_INCREMENT NOT NULL, user_id INT NOT NULL, house_id INT NOT NULL, performance_profile_id INT NOT NULL, INDEX IDX_5DCD699A76ED395 (user_id), INDEX IDX_5DCD6996BB74515 (house_id), INDEX IDX_5DCD699B4135E66 (performance_profile_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE performance_profile (id INT AUTO_INCREMENT NOT NULL, user_id INT NOT NULL, house_id INT NOT NULL, name VARCHAR(255) NOT NULL, description VARCHAR(255) DEFAULT NULL, type VARCHAR(255) NOT NULL, performance_index SMALLINT NOT NULL, profile_day JSON NOT NULL COMMENT \'(DC2Type:json)\', profile_week JSON NOT NULL COMMENT \'(DC2Type:json)\', profile_month JSON NOT NULL COMMENT \'(DC2Type:json)\', profile_year JSON NOT NULL COMMENT \'(DC2Type:json)\', INDEX IDX_228B4255A76ED395 (user_id), INDEX IDX_228B42556BB74515 (house_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE consumption_profile ADD CONSTRAINT FK_5BA47586A76ED395 FOREIGN KEY (user_id) REFERENCES `user` (id)');
        $this->addSql('ALTER TABLE consumption_profile ADD CONSTRAINT FK_5BA475866BB74515 FOREIGN KEY (house_id) REFERENCES house (id)');
        $this->addSql('ALTER TABLE house_consumption_profile ADD CONSTRAINT FK_7CF3E14AA76ED395 FOREIGN KEY (user_id) REFERENCES `user` (id)');
        $this->addSql('ALTER TABLE house_consumption_profile ADD CONSTRAINT FK_7CF3E14A6BB74515 FOREIGN KEY (house_id) REFERENCES house (id)');
        $this->addSql('ALTER TABLE house_consumption_profile ADD CONSTRAINT FK_7CF3E14AA481B FOREIGN KEY (consumption_profile_id) REFERENCES consumption_profile (id)');
        $this->addSql('ALTER TABLE house_performance_profile ADD CONSTRAINT FK_5DCD699A76ED395 FOREIGN KEY (user_id) REFERENCES `user` (id)');
        $this->addSql('ALTER TABLE house_performance_profile ADD CONSTRAINT FK_5DCD6996BB74515 FOREIGN KEY (house_id) REFERENCES house (id)');
        $this->addSql('ALTER TABLE house_performance_profile ADD CONSTRAINT FK_5DCD699B4135E66 FOREIGN KEY (performance_profile_id) REFERENCES performance_profile (id)');
        $this->addSql('ALTER TABLE performance_profile ADD CONSTRAINT FK_228B4255A76ED395 FOREIGN KEY (user_id) REFERENCES `user` (id)');
        $this->addSql('ALTER TABLE performance_profile ADD CONSTRAINT FK_228B42556BB74515 FOREIGN KEY (house_id) REFERENCES house (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE consumption_profile DROP FOREIGN KEY FK_5BA47586A76ED395');
        $this->addSql('ALTER TABLE consumption_profile DROP FOREIGN KEY FK_5BA475866BB74515');
        $this->addSql('ALTER TABLE house_consumption_profile DROP FOREIGN KEY FK_7CF3E14AA76ED395');
        $this->addSql('ALTER TABLE house_consumption_profile DROP FOREIGN KEY FK_7CF3E14A6BB74515');
        $this->addSql('ALTER TABLE house_consumption_profile DROP FOREIGN KEY FK_7CF3E14AA481B');
        $this->addSql('ALTER TABLE house_performance_profile DROP FOREIGN KEY FK_5DCD699A76ED395');
        $this->addSql('ALTER TABLE house_performance_profile DROP FOREIGN KEY FK_5DCD6996BB74515');
        $this->addSql('ALTER TABLE house_performance_profile DROP FOREIGN KEY FK_5DCD699B4135E66');
        $this->addSql('ALTER TABLE performance_profile DROP FOREIGN KEY FK_228B4255A76ED395');
        $this->addSql('ALTER TABLE performance_profile DROP FOREIGN KEY FK_228B42556BB74515');
        $this->addSql('DROP TABLE consumption_profile');
        $this->addSql('DROP TABLE house_consumption_profile');
        $this->addSql('DROP TABLE house_performance_profile');
        $this->addSql('DROP TABLE performance_profile');
    }
}
