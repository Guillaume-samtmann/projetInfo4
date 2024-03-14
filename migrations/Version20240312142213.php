<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240312142213 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE produits_mot_cles (produits_id INTEGER NOT NULL, mot_cles_id INTEGER NOT NULL, PRIMARY KEY(produits_id, mot_cles_id), CONSTRAINT FK_3F2C6CDDCD11A2CF FOREIGN KEY (produits_id) REFERENCES produits (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE, CONSTRAINT FK_3F2C6CDD855234A9 FOREIGN KEY (mot_cles_id) REFERENCES mot_cles (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('CREATE INDEX IDX_3F2C6CDDCD11A2CF ON produits_mot_cles (produits_id)');
        $this->addSql('CREATE INDEX IDX_3F2C6CDD855234A9 ON produits_mot_cles (mot_cles_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE produits_mot_cles');
    }
}
