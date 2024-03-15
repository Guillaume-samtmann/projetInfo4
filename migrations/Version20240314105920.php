<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240314105920 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE produits_decouvrir_aproximiter (produits_id INTEGER NOT NULL, decouvrir_aproximiter_id INTEGER NOT NULL, PRIMARY KEY(produits_id, decouvrir_aproximiter_id), CONSTRAINT FK_D16E6E2FCD11A2CF FOREIGN KEY (produits_id) REFERENCES produits (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE, CONSTRAINT FK_D16E6E2FFE88AB8D FOREIGN KEY (decouvrir_aproximiter_id) REFERENCES decouvrir_aproximiter (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('CREATE INDEX IDX_D16E6E2FCD11A2CF ON produits_decouvrir_aproximiter (produits_id)');
        $this->addSql('CREATE INDEX IDX_D16E6E2FFE88AB8D ON produits_decouvrir_aproximiter (decouvrir_aproximiter_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE produits_decouvrir_aproximiter');
    }
}
