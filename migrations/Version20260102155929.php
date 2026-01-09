<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20260102155929 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE commande (id INT AUTO_INCREMENT NOT NULL, ligne_com_id INT DEFAULT NULL, date_commande DATE NOT NULL, INDEX IDX_6EEAA67D52569371 (ligne_com_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE ligne_com (id INT AUTO_INCREMENT NOT NULL, quantite INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE commande ADD CONSTRAINT FK_6EEAA67D52569371 FOREIGN KEY (ligne_com_id) REFERENCES ligne_com (id)');
        $this->addSql('ALTER TABLE client ADD commande_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE client ADD CONSTRAINT FK_C744045582EA2E54 FOREIGN KEY (commande_id) REFERENCES commande (id)');
        $this->addSql('CREATE INDEX IDX_C744045582EA2E54 ON client (commande_id)');
        $this->addSql('ALTER TABLE produit ADD ligne_com_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE produit ADD CONSTRAINT FK_29A5EC2752569371 FOREIGN KEY (ligne_com_id) REFERENCES ligne_com (id)');
        $this->addSql('CREATE INDEX IDX_29A5EC2752569371 ON produit (ligne_com_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE client DROP FOREIGN KEY FK_C744045582EA2E54');
        $this->addSql('ALTER TABLE produit DROP FOREIGN KEY FK_29A5EC2752569371');
        $this->addSql('ALTER TABLE commande DROP FOREIGN KEY FK_6EEAA67D52569371');
        $this->addSql('DROP TABLE commande');
        $this->addSql('DROP TABLE ligne_com');
        $this->addSql('DROP INDEX IDX_C744045582EA2E54 ON client');
        $this->addSql('ALTER TABLE client DROP commande_id');
        $this->addSql('DROP INDEX IDX_29A5EC2752569371 ON produit');
        $this->addSql('ALTER TABLE produit DROP ligne_com_id');
    }
}
