<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210928141828 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE actualites (id INT AUTO_INCREMENT NOT NULL, chocolaterie_id INT DEFAULT NULL, titre VARCHAR(255) NOT NULL, date DATE NOT NULL, texte VARCHAR(255) NOT NULL, INDEX IDX_75315B6DB81041DB (chocolaterie_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE actualitesimg (id INT AUTO_INCREMENT NOT NULL, actualites_id INT NOT NULL, image VARCHAR(255) NOT NULL, alt VARCHAR(255) NOT NULL, titre VARCHAR(255) NOT NULL, INDEX IDX_F35C140F2EDF1993 (actualites_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE categories (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE chocolaterie (id INT AUTO_INCREMENT NOT NULL, ville VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE commentaires (id INT AUTO_INCREMENT NOT NULL, post_id INT NOT NULL, texte VARCHAR(255) NOT NULL, date DATE NOT NULL, INDEX IDX_D9BEC0C44B89032C (post_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE likes (id INT AUTO_INCREMENT NOT NULL, post_id INT NOT NULL, INDEX IDX_49CA4E7D4B89032C (post_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE post (id INT AUTO_INCREMENT NOT NULL, categories_id INT NOT NULL, titre VARCHAR(255) NOT NULL, description VARCHAR(255) NOT NULL, INDEX IDX_5A8A6C8DA21214B7 (categories_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE postimg (id INT AUTO_INCREMENT NOT NULL, post_id INT NOT NULL, image VARCHAR(255) NOT NULL, alt VARCHAR(255) NOT NULL, titre VARCHAR(255) NOT NULL, INDEX IDX_960A0EB04B89032C (post_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE actualites ADD CONSTRAINT FK_75315B6DB81041DB FOREIGN KEY (chocolaterie_id) REFERENCES chocolaterie (id)');
        $this->addSql('ALTER TABLE actualitesimg ADD CONSTRAINT FK_F35C140F2EDF1993 FOREIGN KEY (actualites_id) REFERENCES actualites (id)');
        $this->addSql('ALTER TABLE commentaires ADD CONSTRAINT FK_D9BEC0C44B89032C FOREIGN KEY (post_id) REFERENCES post (id)');
        $this->addSql('ALTER TABLE likes ADD CONSTRAINT FK_49CA4E7D4B89032C FOREIGN KEY (post_id) REFERENCES post (id)');
        $this->addSql('ALTER TABLE post ADD CONSTRAINT FK_5A8A6C8DA21214B7 FOREIGN KEY (categories_id) REFERENCES categories (id)');
        $this->addSql('ALTER TABLE postimg ADD CONSTRAINT FK_960A0EB04B89032C FOREIGN KEY (post_id) REFERENCES post (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE actualitesimg DROP FOREIGN KEY FK_F35C140F2EDF1993');
        $this->addSql('ALTER TABLE post DROP FOREIGN KEY FK_5A8A6C8DA21214B7');
        $this->addSql('ALTER TABLE actualites DROP FOREIGN KEY FK_75315B6DB81041DB');
        $this->addSql('ALTER TABLE commentaires DROP FOREIGN KEY FK_D9BEC0C44B89032C');
        $this->addSql('ALTER TABLE likes DROP FOREIGN KEY FK_49CA4E7D4B89032C');
        $this->addSql('ALTER TABLE postimg DROP FOREIGN KEY FK_960A0EB04B89032C');
        $this->addSql('DROP TABLE actualites');
        $this->addSql('DROP TABLE actualitesimg');
        $this->addSql('DROP TABLE categories');
        $this->addSql('DROP TABLE chocolaterie');
        $this->addSql('DROP TABLE commentaires');
        $this->addSql('DROP TABLE likes');
        $this->addSql('DROP TABLE post');
        $this->addSql('DROP TABLE postimg');
    }
}
