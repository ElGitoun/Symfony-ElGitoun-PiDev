<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210311122947 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE categorie_equipement (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE publication_equipement ADD categorie_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE publication_equipement ADD CONSTRAINT FK_D6C38312BCF5E72D FOREIGN KEY (categorie_id) REFERENCES categorie_equipement (id)');
        $this->addSql('CREATE INDEX IDX_D6C38312BCF5E72D ON publication_equipement (categorie_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE publication_equipement DROP FOREIGN KEY FK_D6C38312BCF5E72D');
        $this->addSql('DROP TABLE categorie_equipement');
        $this->addSql('DROP INDEX IDX_D6C38312BCF5E72D ON publication_equipement');
        $this->addSql('ALTER TABLE publication_equipement DROP categorie_id');
    }
}
