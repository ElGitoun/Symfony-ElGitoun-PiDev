<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210304152107 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE reservation_evenement (id INT AUTO_INCREMENT NOT NULL, heure_r DATE NOT NULL, date_r DATE NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE user ADD reservation_evenement_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE user ADD CONSTRAINT FK_8D93D6496DC15E11 FOREIGN KEY (reservation_evenement_id) REFERENCES reservation_evenement (id)');
        $this->addSql('CREATE INDEX IDX_8D93D6496DC15E11 ON user (reservation_evenement_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE user DROP FOREIGN KEY FK_8D93D6496DC15E11');
        $this->addSql('DROP TABLE reservation_evenement');
        $this->addSql('DROP INDEX IDX_8D93D6496DC15E11 ON user');
        $this->addSql('ALTER TABLE user DROP reservation_evenement_id');
    }
}
