<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200401125908 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE affaire (id INT AUTO_INCREMENT NOT NULL, designation VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE mairie (id INT AUTO_INCREMENT NOT NULL, ville VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE parti (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE politicien (id INT AUTO_INCREMENT NOT NULL, mairie_id INT DEFAULT NULL, parti_id INT DEFAULT NULL, nom VARCHAR(255) NOT NULL, sexe VARCHAR(255) NOT NULL, age INT NOT NULL, INDEX IDX_D7F73E4DE7A79AB (mairie_id), INDEX IDX_D7F73E4D712547C6 (parti_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE politicien_affaire (politicien_id INT NOT NULL, affaire_id INT NOT NULL, INDEX IDX_91F17A497C1FA7B6 (politicien_id), INDEX IDX_91F17A49F082E755 (affaire_id), PRIMARY KEY(politicien_id, affaire_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_8D93D649E7927C74 (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE politicien ADD CONSTRAINT FK_D7F73E4DE7A79AB FOREIGN KEY (mairie_id) REFERENCES mairie (id)');
        $this->addSql('ALTER TABLE politicien ADD CONSTRAINT FK_D7F73E4D712547C6 FOREIGN KEY (parti_id) REFERENCES parti (id)');
        $this->addSql('ALTER TABLE politicien_affaire ADD CONSTRAINT FK_91F17A497C1FA7B6 FOREIGN KEY (politicien_id) REFERENCES politicien (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE politicien_affaire ADD CONSTRAINT FK_91F17A49F082E755 FOREIGN KEY (affaire_id) REFERENCES affaire (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE politicien_affaire DROP FOREIGN KEY FK_91F17A49F082E755');
        $this->addSql('ALTER TABLE politicien DROP FOREIGN KEY FK_D7F73E4DE7A79AB');
        $this->addSql('ALTER TABLE politicien DROP FOREIGN KEY FK_D7F73E4D712547C6');
        $this->addSql('ALTER TABLE politicien_affaire DROP FOREIGN KEY FK_91F17A497C1FA7B6');
        $this->addSql('DROP TABLE affaire');
        $this->addSql('DROP TABLE mairie');
        $this->addSql('DROP TABLE parti');
        $this->addSql('DROP TABLE politicien');
        $this->addSql('DROP TABLE politicien_affaire');
        $this->addSql('DROP TABLE user');
    }
}
