<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210304161111 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE activite ADD image VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE evenement DROP type');
        $this->addSql('ALTER TABLE reservation_evenement DROP FOREIGN KEY FK_11610981FB88E14F');
        $this->addSql('DROP INDEX IDX_11610981FB88E14F ON reservation_evenement');
        $this->addSql('ALTER TABLE reservation_evenement CHANGE utilisateur_id user_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE reservation_evenement ADD CONSTRAINT FK_11610981A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_11610981A76ED395 ON reservation_evenement (user_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE activite DROP image');
        $this->addSql('ALTER TABLE evenement ADD type VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE reservation_evenement DROP FOREIGN KEY FK_11610981A76ED395');
        $this->addSql('DROP INDEX IDX_11610981A76ED395 ON reservation_evenement');
        $this->addSql('ALTER TABLE reservation_evenement CHANGE user_id utilisateur_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE reservation_evenement ADD CONSTRAINT FK_11610981FB88E14F FOREIGN KEY (utilisateur_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_11610981FB88E14F ON reservation_evenement (utilisateur_id)');
    }
}
