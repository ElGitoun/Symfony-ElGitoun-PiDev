<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210305032014 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE activite (id INT AUTO_INCREMENT NOT NULL, type_activite_id INT DEFAULT NULL, title VARCHAR(255) NOT NULL, description LONGTEXT NOT NULL, price DOUBLE PRECISION NOT NULL, date DATE NOT NULL, duration VARCHAR(255) NOT NULL, size INT NOT NULL, emplacement VARCHAR(255) NOT NULL, INDEX IDX_B8755515D0165F20 (type_activite_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE evenement (id INT AUTO_INCREMENT NOT NULL, type_evenement_id INT DEFAULT NULL, titre VARCHAR(255) NOT NULL, description LONGTEXT NOT NULL, price DOUBLE PRECISION NOT NULL, location VARCHAR(255) NOT NULL, date DATE NOT NULL, duration TIME NOT NULL, size INT NOT NULL, image VARCHAR(255) NOT NULL, INDEX IDX_B26681E88939516 (type_evenement_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE feedback (id INT AUTO_INCREMENT NOT NULL, user_id INT DEFAULT NULL, date DATE NOT NULL, note INT NOT NULL, INDEX IDX_D2294458A76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE forum_commentaire (id INT AUTO_INCREMENT NOT NULL, publication_id INT DEFAULT NULL, date VARCHAR(255) NOT NULL, description LONGTEXT NOT NULL, reaction INT NOT NULL, INDEX IDX_61C4EB1E38B217A7 (publication_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE publication_equipement (id INT AUTO_INCREMENT NOT NULL, user_id INT DEFAULT NULL, type_publication_id INT DEFAULT NULL, date DATE NOT NULL, title VARCHAR(255) NOT NULL, description LONGTEXT NOT NULL, price DOUBLE PRECISION NOT NULL, image VARCHAR(255) NOT NULL, INDEX IDX_D6C38312A76ED395 (user_id), INDEX IDX_D6C383126E713E33 (type_publication_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE publication_forum (id INT AUTO_INCREMENT NOT NULL, user_id INT DEFAULT NULL, titre VARCHAR(255) NOT NULL, description LONGTEXT NOT NULL, date DATE NOT NULL, image VARCHAR(255) NOT NULL, INDEX IDX_60F5F841A76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE reservation_activite (id INT AUTO_INCREMENT NOT NULL, user_id INT DEFAULT NULL, activite_id INT DEFAULT NULL, heure_ra VARCHAR(255) NOT NULL, date_ra DATE NOT NULL, INDEX IDX_25C0B701A76ED395 (user_id), INDEX IDX_25C0B7019B0F88B1 (activite_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE reservation_evenement (id INT AUTO_INCREMENT NOT NULL, user_id INT DEFAULT NULL, evenement_id INT DEFAULT NULL, heure_r DATE NOT NULL, date_r DATE NOT NULL, INDEX IDX_11610981A76ED395 (user_id), INDEX IDX_11610981FD02F13 (evenement_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE type_activite (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE type_evenement (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE type_publication (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, first_name VARCHAR(255) NOT NULL, last_name VARCHAR(255) NOT NULL, email VARCHAR(255) NOT NULL, birth_date DATE DEFAULT NULL, gender VARCHAR(255) DEFAULT NULL, image VARCHAR(255) DEFAULT NULL, role TINYINT(1) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE activite ADD CONSTRAINT FK_B8755515D0165F20 FOREIGN KEY (type_activite_id) REFERENCES type_activite (id)');
        $this->addSql('ALTER TABLE evenement ADD CONSTRAINT FK_B26681E88939516 FOREIGN KEY (type_evenement_id) REFERENCES type_evenement (id)');
        $this->addSql('ALTER TABLE feedback ADD CONSTRAINT FK_D2294458A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE forum_commentaire ADD CONSTRAINT FK_61C4EB1E38B217A7 FOREIGN KEY (publication_id) REFERENCES publication_forum (id)');
        $this->addSql('ALTER TABLE publication_equipement ADD CONSTRAINT FK_D6C38312A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE publication_equipement ADD CONSTRAINT FK_D6C383126E713E33 FOREIGN KEY (type_publication_id) REFERENCES type_publication (id)');
        $this->addSql('ALTER TABLE publication_forum ADD CONSTRAINT FK_60F5F841A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE reservation_activite ADD CONSTRAINT FK_25C0B701A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE reservation_activite ADD CONSTRAINT FK_25C0B7019B0F88B1 FOREIGN KEY (activite_id) REFERENCES activite (id)');
        $this->addSql('ALTER TABLE reservation_evenement ADD CONSTRAINT FK_11610981A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE reservation_evenement ADD CONSTRAINT FK_11610981FD02F13 FOREIGN KEY (evenement_id) REFERENCES evenement (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE reservation_activite DROP FOREIGN KEY FK_25C0B7019B0F88B1');
        $this->addSql('ALTER TABLE reservation_evenement DROP FOREIGN KEY FK_11610981FD02F13');
        $this->addSql('ALTER TABLE forum_commentaire DROP FOREIGN KEY FK_61C4EB1E38B217A7');
        $this->addSql('ALTER TABLE activite DROP FOREIGN KEY FK_B8755515D0165F20');
        $this->addSql('ALTER TABLE evenement DROP FOREIGN KEY FK_B26681E88939516');
        $this->addSql('ALTER TABLE publication_equipement DROP FOREIGN KEY FK_D6C383126E713E33');
        $this->addSql('ALTER TABLE feedback DROP FOREIGN KEY FK_D2294458A76ED395');
        $this->addSql('ALTER TABLE publication_equipement DROP FOREIGN KEY FK_D6C38312A76ED395');
        $this->addSql('ALTER TABLE publication_forum DROP FOREIGN KEY FK_60F5F841A76ED395');
        $this->addSql('ALTER TABLE reservation_activite DROP FOREIGN KEY FK_25C0B701A76ED395');
        $this->addSql('ALTER TABLE reservation_evenement DROP FOREIGN KEY FK_11610981A76ED395');
        $this->addSql('DROP TABLE activite');
        $this->addSql('DROP TABLE evenement');
        $this->addSql('DROP TABLE feedback');
        $this->addSql('DROP TABLE forum_commentaire');
        $this->addSql('DROP TABLE publication_equipement');
        $this->addSql('DROP TABLE publication_forum');
        $this->addSql('DROP TABLE reservation_activite');
        $this->addSql('DROP TABLE reservation_evenement');
        $this->addSql('DROP TABLE type_activite');
        $this->addSql('DROP TABLE type_evenement');
        $this->addSql('DROP TABLE type_publication');
        $this->addSql('DROP TABLE user');
    }
}
