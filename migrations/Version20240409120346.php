<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240409120346 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE panier (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, user_id INTEGER DEFAULT NULL, CONSTRAINT FK_24CC0DF2A76ED395 FOREIGN KEY (user_id) REFERENCES user (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('CREATE INDEX IDX_24CC0DF2A76ED395 ON panier (user_id)');
        $this->addSql('CREATE TEMPORARY TABLE __temp__produits AS SELECT id, ville_id, informations_horraire_arv_id, informations_horraire_depart_id, informations_annimaux_id, region_id, nom, description, photo, prix, nbr_nuit, photo2, photo3, photo4, photo5, photo6 FROM produits');
        $this->addSql('DROP TABLE produits');
        $this->addSql('CREATE TABLE produits (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, ville_id INTEGER DEFAULT NULL, informations_horraire_arv_id INTEGER DEFAULT NULL, informations_horraire_depart_id INTEGER DEFAULT NULL, informations_annimaux_id INTEGER DEFAULT NULL, region_id INTEGER DEFAULT NULL, nom VARCHAR(255) NOT NULL, description CLOB NOT NULL, photo VARCHAR(255) NOT NULL, prix VARCHAR(255) NOT NULL, nbr_nuit VARCHAR(255) NOT NULL, photo2 VARCHAR(255) NOT NULL, photo3 VARCHAR(255) NOT NULL, photo4 VARCHAR(255) NOT NULL, photo5 VARCHAR(255) NOT NULL, photo6 VARCHAR(255) NOT NULL, CONSTRAINT FK_BE2DDF8CA73F0036 FOREIGN KEY (ville_id) REFERENCES ville (id) ON UPDATE NO ACTION ON DELETE NO ACTION NOT DEFERRABLE INITIALLY IMMEDIATE, CONSTRAINT FK_BE2DDF8C2AEEE24F FOREIGN KEY (informations_horraire_arv_id) REFERENCES informations_horraire_arv (id) ON UPDATE NO ACTION ON DELETE NO ACTION NOT DEFERRABLE INITIALLY IMMEDIATE, CONSTRAINT FK_BE2DDF8C101D8E60 FOREIGN KEY (informations_horraire_depart_id) REFERENCES informations_horraire_deaprt (id) ON UPDATE NO ACTION ON DELETE NO ACTION NOT DEFERRABLE INITIALLY IMMEDIATE, CONSTRAINT FK_BE2DDF8C4D3793AB FOREIGN KEY (informations_annimaux_id) REFERENCES informations_annimaux (id) ON UPDATE NO ACTION ON DELETE NO ACTION NOT DEFERRABLE INITIALLY IMMEDIATE, CONSTRAINT FK_BE2DDF8C98260155 FOREIGN KEY (region_id) REFERENCES region (id) ON UPDATE NO ACTION ON DELETE NO ACTION NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO produits (id, ville_id, informations_horraire_arv_id, informations_horraire_depart_id, informations_annimaux_id, region_id, nom, description, photo, prix, nbr_nuit, photo2, photo3, photo4, photo5, photo6) SELECT id, ville_id, informations_horraire_arv_id, informations_horraire_depart_id, informations_annimaux_id, region_id, nom, description, photo, prix, nbr_nuit, photo2, photo3, photo4, photo5, photo6 FROM __temp__produits');
        $this->addSql('DROP TABLE __temp__produits');
        $this->addSql('CREATE INDEX IDX_BE2DDF8C98260155 ON produits (region_id)');
        $this->addSql('CREATE INDEX IDX_BE2DDF8C101D8E60 ON produits (informations_horraire_depart_id)');
        $this->addSql('CREATE INDEX IDX_BE2DDF8CA73F0036 ON produits (ville_id)');
        $this->addSql('CREATE INDEX IDX_BE2DDF8C2AEEE24F ON produits (informations_horraire_arv_id)');
        $this->addSql('CREATE INDEX IDX_BE2DDF8C4D3793AB ON produits (informations_annimaux_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE panier');
        $this->addSql('CREATE TEMPORARY TABLE __temp__produits AS SELECT id, ville_id, informations_horraire_arv_id, informations_horraire_depart_id, informations_annimaux_id, region_id, nom, description, photo, prix, nbr_nuit, photo2, photo3, photo4, photo5, photo6 FROM produits');
        $this->addSql('DROP TABLE produits');
        $this->addSql('CREATE TABLE produits (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, ville_id INTEGER DEFAULT NULL, informations_horraire_arv_id INTEGER DEFAULT NULL, informations_horraire_depart_id INTEGER DEFAULT NULL, informations_annimaux_id INTEGER DEFAULT NULL, region_id INTEGER DEFAULT NULL, panier_id INTEGER DEFAULT NULL, nom VARCHAR(255) NOT NULL, description CLOB NOT NULL, photo VARCHAR(255) NOT NULL, prix VARCHAR(255) NOT NULL, nbr_nuit VARCHAR(255) NOT NULL, photo2 VARCHAR(255) NOT NULL, photo3 VARCHAR(255) NOT NULL, photo4 VARCHAR(255) NOT NULL, photo5 VARCHAR(255) NOT NULL, photo6 VARCHAR(255) NOT NULL, CONSTRAINT FK_BE2DDF8CA73F0036 FOREIGN KEY (ville_id) REFERENCES ville (id) NOT DEFERRABLE INITIALLY IMMEDIATE, CONSTRAINT FK_BE2DDF8C2AEEE24F FOREIGN KEY (informations_horraire_arv_id) REFERENCES informations_horraire_arv (id) NOT DEFERRABLE INITIALLY IMMEDIATE, CONSTRAINT FK_BE2DDF8C101D8E60 FOREIGN KEY (informations_horraire_depart_id) REFERENCES informations_horraire_deaprt (id) NOT DEFERRABLE INITIALLY IMMEDIATE, CONSTRAINT FK_BE2DDF8C4D3793AB FOREIGN KEY (informations_annimaux_id) REFERENCES informations_annimaux (id) NOT DEFERRABLE INITIALLY IMMEDIATE, CONSTRAINT FK_BE2DDF8C98260155 FOREIGN KEY (region_id) REFERENCES region (id) NOT DEFERRABLE INITIALLY IMMEDIATE, CONSTRAINT FK_BE2DDF8CF77D927C FOREIGN KEY (panier_id) REFERENCES panier (id) ON UPDATE NO ACTION ON DELETE NO ACTION NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO produits (id, ville_id, informations_horraire_arv_id, informations_horraire_depart_id, informations_annimaux_id, region_id, nom, description, photo, prix, nbr_nuit, photo2, photo3, photo4, photo5, photo6) SELECT id, ville_id, informations_horraire_arv_id, informations_horraire_depart_id, informations_annimaux_id, region_id, nom, description, photo, prix, nbr_nuit, photo2, photo3, photo4, photo5, photo6 FROM __temp__produits');
        $this->addSql('DROP TABLE __temp__produits');
        $this->addSql('CREATE INDEX IDX_BE2DDF8CA73F0036 ON produits (ville_id)');
        $this->addSql('CREATE INDEX IDX_BE2DDF8C2AEEE24F ON produits (informations_horraire_arv_id)');
        $this->addSql('CREATE INDEX IDX_BE2DDF8C101D8E60 ON produits (informations_horraire_depart_id)');
        $this->addSql('CREATE INDEX IDX_BE2DDF8C4D3793AB ON produits (informations_annimaux_id)');
        $this->addSql('CREATE INDEX IDX_BE2DDF8C98260155 ON produits (region_id)');
        $this->addSql('CREATE INDEX IDX_BE2DDF8CF77D927C ON produits (panier_id)');
    }
}
