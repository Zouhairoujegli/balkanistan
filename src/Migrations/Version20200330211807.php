<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200330211807 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE politicien_affaire (politicien_id INT NOT NULL, affaire_id INT NOT NULL, INDEX IDX_91F17A497C1FA7B6 (politicien_id), INDEX IDX_91F17A49F082E755 (affaire_id), PRIMARY KEY(politicien_id, affaire_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE politicien_affaire ADD CONSTRAINT FK_91F17A497C1FA7B6 FOREIGN KEY (politicien_id) REFERENCES politicien (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE politicien_affaire ADD CONSTRAINT FK_91F17A49F082E755 FOREIGN KEY (affaire_id) REFERENCES affaire (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE politicien ADD mairie_id INT DEFAULT NULL, ADD parti_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE politicien ADD CONSTRAINT FK_D7F73E4DE7A79AB FOREIGN KEY (mairie_id) REFERENCES mairie (id)');
        $this->addSql('ALTER TABLE politicien ADD CONSTRAINT FK_D7F73E4D712547C6 FOREIGN KEY (parti_id) REFERENCES parti (id)');
        $this->addSql('CREATE INDEX IDX_D7F73E4DE7A79AB ON politicien (mairie_id)');
        $this->addSql('CREATE INDEX IDX_D7F73E4D712547C6 ON politicien (parti_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE politicien_affaire');
        $this->addSql('ALTER TABLE politicien DROP FOREIGN KEY FK_D7F73E4DE7A79AB');
        $this->addSql('ALTER TABLE politicien DROP FOREIGN KEY FK_D7F73E4D712547C6');
        $this->addSql('DROP INDEX IDX_D7F73E4DE7A79AB ON politicien');
        $this->addSql('DROP INDEX IDX_D7F73E4D712547C6 ON politicien');
        $this->addSql('ALTER TABLE politicien DROP mairie_id, DROP parti_id');
    }
}
