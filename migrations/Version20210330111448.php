<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210330111448 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE reservation_activite DROP FOREIGN KEY FK_25C0B701A76ED395');
        $this->addSql('ALTER TABLE reservation_activite DROP heure_ra, DROP date_ra');
        $this->addSql('ALTER TABLE reservation_activite ADD CONSTRAINT FK_25C0B701A76ED395 FOREIGN KEY (user_id) REFERENCES users (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE reservation_activite DROP FOREIGN KEY FK_25C0B701A76ED395');
        $this->addSql('ALTER TABLE reservation_activite ADD heure_ra VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, ADD date_ra DATE NOT NULL');
        $this->addSql('ALTER TABLE reservation_activite ADD CONSTRAINT FK_25C0B701A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
    }
}
