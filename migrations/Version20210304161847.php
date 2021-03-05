<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210304161847 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE type_publication (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE publication_equipement ADD type_publication_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE publication_equipement ADD CONSTRAINT FK_D6C383126E713E33 FOREIGN KEY (type_publication_id) REFERENCES type_publication (id)');
        $this->addSql('CREATE INDEX IDX_D6C383126E713E33 ON publication_equipement (type_publication_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE publication_equipement DROP FOREIGN KEY FK_D6C383126E713E33');
        $this->addSql('DROP TABLE type_publication');
        $this->addSql('DROP INDEX IDX_D6C383126E713E33 ON publication_equipement');
        $this->addSql('ALTER TABLE publication_equipement DROP type_publication_id');
    }
}
