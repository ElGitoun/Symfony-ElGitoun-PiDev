<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210304154622 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE publication_forum (id INT AUTO_INCREMENT NOT NULL, user_id INT DEFAULT NULL, titre VARCHAR(255) NOT NULL, description LONGTEXT NOT NULL, date DATE NOT NULL, image VARCHAR(255) NOT NULL, INDEX IDX_60F5F841A76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE type_activite (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE publication_forum ADD CONSTRAINT FK_60F5F841A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE activite ADD type_activite_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE activite ADD CONSTRAINT FK_B8755515D0165F20 FOREIGN KEY (type_activite_id) REFERENCES activite (id)');
        $this->addSql('CREATE INDEX IDX_B8755515D0165F20 ON activite (type_activite_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE publication_forum');
        $this->addSql('DROP TABLE type_activite');
        $this->addSql('ALTER TABLE activite DROP FOREIGN KEY FK_B8755515D0165F20');
        $this->addSql('DROP INDEX IDX_B8755515D0165F20 ON activite');
        $this->addSql('ALTER TABLE activite DROP type_activite_id');
    }
}
