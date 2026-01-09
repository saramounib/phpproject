<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20260109191410 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE produit DROP INDEX UNIQ_29A5EC279F34925F, ADD INDEX IDX_29A5EC27BCF5E72D (categorie_id)');
        $this->addSql('ALTER TABLE produit CHANGE nom nom VARCHAR(255) NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE produit DROP INDEX IDX_29A5EC27BCF5E72D, ADD UNIQUE INDEX UNIQ_29A5EC279F34925F (categorie_id)');
        $this->addSql('ALTER TABLE produit CHANGE nom nom VARCHAR(20) NOT NULL');
    }
}
