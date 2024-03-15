<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240314100857 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE produits_decouvrir_sur_place (produits_id INTEGER NOT NULL, decouvrir_sur_place_id INTEGER NOT NULL, PRIMARY KEY(produits_id, decouvrir_sur_place_id), CONSTRAINT FK_5C3BB9F9CD11A2CF FOREIGN KEY (produits_id) REFERENCES produits (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE, CONSTRAINT FK_5C3BB9F9BCFC1B84 FOREIGN KEY (decouvrir_sur_place_id) REFERENCES decouvrir_sur_place (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('CREATE INDEX IDX_5C3BB9F9CD11A2CF ON produits_decouvrir_sur_place (produits_id)');
        $this->addSql('CREATE INDEX IDX_5C3BB9F9BCFC1B84 ON produits_decouvrir_sur_place (decouvrir_sur_place_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE produits_decouvrir_sur_place');
    }
}
