<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240314053117 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql("ALTER TABLE produits ADD COLUMN photo2 VARCHAR(255) NOT NULL DEFAULT 'valeur_par_defaut'");
        $this->addSql("ALTER TABLE produits ADD COLUMN photo3 VARCHAR(255) NOT NULL DEFAULT 'valeur_par_defaut'");
        $this->addSql("ALTER TABLE produits ADD COLUMN photo4 VARCHAR(255) NOT NULL DEFAULT 'valeur_par_defaut'");
        $this->addSql("ALTER TABLE produits ADD COLUMN photo5 VARCHAR(255) NOT NULL DEFAULT 'valeur_par_defaut'");
        $this->addSql("ALTER TABLE produits ADD COLUMN photo6 VARCHAR(255) NOT NULL DEFAULT 'valeur_par_defaut'");
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TEMPORARY TABLE __temp__produits AS SELECT id, ville_id, nom, description, photo, prix, nbr_nuit FROM produits');
        $this->addSql('DROP TABLE produits');
        $this->addSql('CREATE TABLE produits (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, ville_id INTEGER DEFAULT NULL, nom VARCHAR(255) NOT NULL, description CLOB NOT NULL, photo VARCHAR(255) NOT NULL, prix VARCHAR(255) NOT NULL, nbr_nuit VARCHAR(255) NOT NULL, CONSTRAINT FK_BE2DDF8CA73F0036 FOREIGN KEY (ville_id) REFERENCES ville (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO produits (id, ville_id, nom, description, photo, prix, nbr_nuit) SELECT id, ville_id, nom, description, photo, prix, nbr_nuit FROM __temp__produits');
        $this->addSql('DROP TABLE __temp__produits');
        $this->addSql('CREATE INDEX IDX_BE2DDF8CA73F0036 ON produits (ville_id)');
    }
}
