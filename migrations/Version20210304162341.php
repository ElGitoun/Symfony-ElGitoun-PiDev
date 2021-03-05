<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210304162341 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE feedback (id INT AUTO_INCREMENT NOT NULL, date DATE NOT NULL, note INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE forum_commentaire (id INT AUTO_INCREMENT NOT NULL, date VARCHAR(255) NOT NULL, description LONGTEXT NOT NULL, reaction INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE publication_forum ADD commentaire_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE publication_forum ADD CONSTRAINT FK_60F5F841BA9CD190 FOREIGN KEY (commentaire_id) REFERENCES forum_commentaire (id)');
        $this->addSql('CREATE INDEX IDX_60F5F841BA9CD190 ON publication_forum (commentaire_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE publication_forum DROP FOREIGN KEY FK_60F5F841BA9CD190');
        $this->addSql('DROP TABLE feedback');
        $this->addSql('DROP TABLE forum_commentaire');
        $this->addSql('DROP INDEX IDX_60F5F841BA9CD190 ON publication_forum');
        $this->addSql('ALTER TABLE publication_forum DROP commentaire_id');
    }
}
