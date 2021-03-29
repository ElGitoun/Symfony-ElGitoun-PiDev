<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210326122129 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE feedback DROP FOREIGN KEY FK_D2294458E368C1BA');
        $this->addSql('DROP INDEX UNIQ_D2294458E368C1BA ON feedback');
        $this->addSql('ALTER TABLE feedback DROP ownerfeedback_id');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE feedback ADD ownerfeedback_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE feedback ADD CONSTRAINT FK_D2294458E368C1BA FOREIGN KEY (ownerfeedback_id) REFERENCES user (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_D2294458E368C1BA ON feedback (ownerfeedback_id)');
    }
}
