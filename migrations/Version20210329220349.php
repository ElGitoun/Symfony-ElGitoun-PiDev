<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210329220349 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE forum_commentaire ADD publication_forums_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE forum_commentaire ADD CONSTRAINT FK_61C4EB1E7DC8A5DC FOREIGN KEY (publication_forums_id) REFERENCES publication_forum (id)');
        $this->addSql('CREATE INDEX IDX_61C4EB1E7DC8A5DC ON forum_commentaire (publication_forums_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE forum_commentaire DROP FOREIGN KEY FK_61C4EB1E7DC8A5DC');
        $this->addSql('DROP INDEX IDX_61C4EB1E7DC8A5DC ON forum_commentaire');
        $this->addSql('ALTER TABLE forum_commentaire DROP publication_forums_id');
    }
}
