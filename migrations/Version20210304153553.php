<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210304153553 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE reservation_activite ADD user_id INT DEFAULT NULL, ADD activite_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE reservation_activite ADD CONSTRAINT FK_25C0B701A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE reservation_activite ADD CONSTRAINT FK_25C0B7019B0F88B1 FOREIGN KEY (activite_id) REFERENCES activite (id)');
        $this->addSql('CREATE INDEX IDX_25C0B701A76ED395 ON reservation_activite (user_id)');
        $this->addSql('CREATE INDEX IDX_25C0B7019B0F88B1 ON reservation_activite (activite_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE reservation_activite DROP FOREIGN KEY FK_25C0B701A76ED395');
        $this->addSql('ALTER TABLE reservation_activite DROP FOREIGN KEY FK_25C0B7019B0F88B1');
        $this->addSql('DROP INDEX IDX_25C0B701A76ED395 ON reservation_activite');
        $this->addSql('DROP INDEX IDX_25C0B7019B0F88B1 ON reservation_activite');
        $this->addSql('ALTER TABLE reservation_activite DROP user_id, DROP activite_id');
    }
}
