<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240317193808 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql("ALTER TABLE mot_cles ADD COLUMN image VARCHAR(255) NOT NULL DEFAULT 'valeur_par_defaut'");
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TEMPORARY TABLE __temp__mot_cles AS SELECT id, nom FROM mot_cles');
        $this->addSql('DROP TABLE mot_cles');
        $this->addSql('CREATE TABLE mot_cles (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, nom VARCHAR(255) NOT NULL)');
        $this->addSql('INSERT INTO mot_cles (id, nom) SELECT id, nom FROM __temp__mot_cles');
        $this->addSql('DROP TABLE __temp__mot_cles');
    }
}
