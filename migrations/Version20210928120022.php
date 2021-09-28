<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210928120022 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE actualites ADD chocolaterie_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE actualites ADD CONSTRAINT FK_75315B6DB81041DB FOREIGN KEY (chocolaterie_id) REFERENCES chocolaterie (id)');
        $this->addSql('CREATE INDEX IDX_75315B6DB81041DB ON actualites (chocolaterie_id)');
        $this->addSql('ALTER TABLE actualitesimg ADD actualites_id INT NOT NULL');
        $this->addSql('ALTER TABLE actualitesimg ADD CONSTRAINT FK_F35C140F2EDF1993 FOREIGN KEY (actualites_id) REFERENCES actualites (id)');
        $this->addSql('CREATE INDEX IDX_F35C140F2EDF1993 ON actualitesimg (actualites_id)');
        $this->addSql('ALTER TABLE commentaires ADD user_id INT NOT NULL, ADD post_id INT NOT NULL');
        $this->addSql('ALTER TABLE commentaires ADD CONSTRAINT FK_D9BEC0C4A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE commentaires ADD CONSTRAINT FK_D9BEC0C44B89032C FOREIGN KEY (post_id) REFERENCES post (id)');
        $this->addSql('CREATE INDEX IDX_D9BEC0C4A76ED395 ON commentaires (user_id)');
        $this->addSql('CREATE INDEX IDX_D9BEC0C44B89032C ON commentaires (post_id)');
        $this->addSql('ALTER TABLE likes ADD user_id INT NOT NULL, ADD post_id INT NOT NULL');
        $this->addSql('ALTER TABLE likes ADD CONSTRAINT FK_49CA4E7DA76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE likes ADD CONSTRAINT FK_49CA4E7D4B89032C FOREIGN KEY (post_id) REFERENCES post (id)');
        $this->addSql('CREATE INDEX IDX_49CA4E7DA76ED395 ON likes (user_id)');
        $this->addSql('CREATE INDEX IDX_49CA4E7D4B89032C ON likes (post_id)');
        $this->addSql('ALTER TABLE post ADD user_id INT NOT NULL, ADD categories_id INT NOT NULL');
        $this->addSql('ALTER TABLE post ADD CONSTRAINT FK_5A8A6C8DA76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE post ADD CONSTRAINT FK_5A8A6C8DA21214B7 FOREIGN KEY (categories_id) REFERENCES categories (id)');
        $this->addSql('CREATE INDEX IDX_5A8A6C8DA76ED395 ON post (user_id)');
        $this->addSql('CREATE INDEX IDX_5A8A6C8DA21214B7 ON post (categories_id)');
        $this->addSql('ALTER TABLE postimg ADD post_id INT NOT NULL');
        $this->addSql('ALTER TABLE postimg ADD CONSTRAINT FK_960A0EB04B89032C FOREIGN KEY (post_id) REFERENCES post (id)');
        $this->addSql('CREATE INDEX IDX_960A0EB04B89032C ON postimg (post_id)');
        $this->addSql('ALTER TABLE user ADD chocolaterie_id INT NOT NULL');
        $this->addSql('ALTER TABLE user ADD CONSTRAINT FK_8D93D649B81041DB FOREIGN KEY (chocolaterie_id) REFERENCES chocolaterie (id)');
        $this->addSql('CREATE INDEX IDX_8D93D649B81041DB ON user (chocolaterie_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE actualites DROP FOREIGN KEY FK_75315B6DB81041DB');
        $this->addSql('DROP INDEX IDX_75315B6DB81041DB ON actualites');
        $this->addSql('ALTER TABLE actualites DROP chocolaterie_id');
        $this->addSql('ALTER TABLE actualitesimg DROP FOREIGN KEY FK_F35C140F2EDF1993');
        $this->addSql('DROP INDEX IDX_F35C140F2EDF1993 ON actualitesimg');
        $this->addSql('ALTER TABLE actualitesimg DROP actualites_id');
        $this->addSql('ALTER TABLE commentaires DROP FOREIGN KEY FK_D9BEC0C4A76ED395');
        $this->addSql('ALTER TABLE commentaires DROP FOREIGN KEY FK_D9BEC0C44B89032C');
        $this->addSql('DROP INDEX IDX_D9BEC0C4A76ED395 ON commentaires');
        $this->addSql('DROP INDEX IDX_D9BEC0C44B89032C ON commentaires');
        $this->addSql('ALTER TABLE commentaires DROP user_id, DROP post_id');
        $this->addSql('ALTER TABLE likes DROP FOREIGN KEY FK_49CA4E7DA76ED395');
        $this->addSql('ALTER TABLE likes DROP FOREIGN KEY FK_49CA4E7D4B89032C');
        $this->addSql('DROP INDEX IDX_49CA4E7DA76ED395 ON likes');
        $this->addSql('DROP INDEX IDX_49CA4E7D4B89032C ON likes');
        $this->addSql('ALTER TABLE likes DROP user_id, DROP post_id');
        $this->addSql('ALTER TABLE post DROP FOREIGN KEY FK_5A8A6C8DA76ED395');
        $this->addSql('ALTER TABLE post DROP FOREIGN KEY FK_5A8A6C8DA21214B7');
        $this->addSql('DROP INDEX IDX_5A8A6C8DA76ED395 ON post');
        $this->addSql('DROP INDEX IDX_5A8A6C8DA21214B7 ON post');
        $this->addSql('ALTER TABLE post DROP user_id, DROP categories_id');
        $this->addSql('ALTER TABLE postimg DROP FOREIGN KEY FK_960A0EB04B89032C');
        $this->addSql('DROP INDEX IDX_960A0EB04B89032C ON postimg');
        $this->addSql('ALTER TABLE postimg DROP post_id');
        $this->addSql('ALTER TABLE user DROP FOREIGN KEY FK_8D93D649B81041DB');
        $this->addSql('DROP INDEX IDX_8D93D649B81041DB ON user');
        $this->addSql('ALTER TABLE user DROP chocolaterie_id');
    }
}
