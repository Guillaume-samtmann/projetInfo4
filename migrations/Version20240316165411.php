<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240316165411 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE informations_horraire_arv (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, nom VARCHAR(255) NOT NULL)');
        $this->addSql('CREATE TABLE produits_informations_horraire_arv (produits_id INTEGER NOT NULL, informations_horraire_arv_id INTEGER NOT NULL, PRIMARY KEY(produits_id, informations_horraire_arv_id), CONSTRAINT FK_93490956CD11A2CF FOREIGN KEY (produits_id) REFERENCES produits (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE, CONSTRAINT FK_934909562AEEE24F FOREIGN KEY (informations_horraire_arv_id) REFERENCES informations_horraire_arv (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('CREATE INDEX IDX_93490956CD11A2CF ON produits_informations_horraire_arv (produits_id)');
        $this->addSql('CREATE INDEX IDX_934909562AEEE24F ON produits_informations_horraire_arv (informations_horraire_arv_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE informations_horraire_arv');
        $this->addSql('DROP TABLE produits_informations_horraire_arv');
    }
}
