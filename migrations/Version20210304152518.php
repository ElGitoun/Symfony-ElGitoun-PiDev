<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210304152518 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE reservation_evenement ADD utilisateur_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE reservation_evenement ADD CONSTRAINT FK_11610981FB88E14F FOREIGN KEY (utilisateur_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_11610981FB88E14F ON reservation_evenement (utilisateur_id)');
        $this->addSql('ALTER TABLE user DROP FOREIGN KEY FK_8D93D6496DC15E11');
        $this->addSql('DROP INDEX IDX_8D93D6496DC15E11 ON user');
        $this->addSql('ALTER TABLE user DROP reservation_evenement_id');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE reservation_evenement DROP FOREIGN KEY FK_11610981FB88E14F');
        $this->addSql('DROP INDEX IDX_11610981FB88E14F ON reservation_evenement');
        $this->addSql('ALTER TABLE reservation_evenement DROP utilisateur_id');
        $this->addSql('ALTER TABLE user ADD reservation_evenement_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE user ADD CONSTRAINT FK_8D93D6496DC15E11 FOREIGN KEY (reservation_evenement_id) REFERENCES reservation_evenement (id)');
        $this->addSql('CREATE INDEX IDX_8D93D6496DC15E11 ON user (reservation_evenement_id)');
    }
}
