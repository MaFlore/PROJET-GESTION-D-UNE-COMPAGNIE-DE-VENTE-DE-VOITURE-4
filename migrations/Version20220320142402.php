<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220320142402 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE personne ADD creer_par VARCHAR(255) NOT NULL, ADD creer_le DATETIME NOT NULL, ADD modifier_par VARCHAR(255) DEFAULT NULL, ADD modifier_le DATETIME DEFAULT NULL, ADD enable TINYINT(1) NOT NULL');
        $this->addSql('ALTER TABLE vente ADD creer_par VARCHAR(255) NOT NULL, ADD creer_le DATETIME NOT NULL, ADD modifier_par VARCHAR(255) DEFAULT NULL, ADD modifier_le DATETIME DEFAULT NULL, ADD enable TINYINT(1) NOT NULL');
        $this->addSql('ALTER TABLE voiture ADD creer_par VARCHAR(255) NOT NULL, ADD creer_le DATETIME NOT NULL, ADD modifier_par VARCHAR(255) DEFAULT NULL, ADD modifier_le DATETIME DEFAULT NULL, ADD enable TINYINT(1) NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE Personne DROP creer_par, DROP creer_le, DROP modifier_par, DROP modifier_le, DROP enable');
        $this->addSql('ALTER TABLE vente DROP creer_par, DROP creer_le, DROP modifier_par, DROP modifier_le, DROP enable');
        $this->addSql('ALTER TABLE voiture DROP creer_par, DROP creer_le, DROP modifier_par, DROP modifier_le, DROP enable');
    }
}
