<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210304162734 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE feedback ADD user_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE feedback ADD CONSTRAINT FK_D2294458A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_D2294458A76ED395 ON feedback (user_id)');
        $this->addSql('ALTER TABLE forum_commentaire ADD publication_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE forum_commentaire ADD CONSTRAINT FK_61C4EB1E38B217A7 FOREIGN KEY (publication_id) REFERENCES publication_forum (id)');
        $this->addSql('CREATE INDEX IDX_61C4EB1E38B217A7 ON forum_commentaire (publication_id)');
        $this->addSql('ALTER TABLE publication_forum DROP FOREIGN KEY FK_60F5F841BA9CD190');
        $this->addSql('DROP INDEX IDX_60F5F841BA9CD190 ON publication_forum');
        $this->addSql('ALTER TABLE publication_forum DROP commentaire_id');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE feedback DROP FOREIGN KEY FK_D2294458A76ED395');
        $this->addSql('DROP INDEX IDX_D2294458A76ED395 ON feedback');
        $this->addSql('ALTER TABLE feedback DROP user_id');
        $this->addSql('ALTER TABLE forum_commentaire DROP FOREIGN KEY FK_61C4EB1E38B217A7');
        $this->addSql('DROP INDEX IDX_61C4EB1E38B217A7 ON forum_commentaire');
        $this->addSql('ALTER TABLE forum_commentaire DROP publication_id');
        $this->addSql('ALTER TABLE publication_forum ADD commentaire_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE publication_forum ADD CONSTRAINT FK_60F5F841BA9CD190 FOREIGN KEY (commentaire_id) REFERENCES forum_commentaire (id)');
        $this->addSql('CREATE INDEX IDX_60F5F841BA9CD190 ON publication_forum (commentaire_id)');
    }
}
