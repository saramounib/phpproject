<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20260102155504 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE ligne_panier (id INT AUTO_INCREMENT NOT NULL, quantite INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE produit (id INT AUTO_INCREMENT NOT NULL, id_categorie_id INT NOT NULL, ligne_panier_id INT DEFAULT NULL, nom VARCHAR(20) NOT NULL, prix DOUBLE PRECISION NOT NULL, UNIQUE INDEX UNIQ_29A5EC279F34925F (id_categorie_id), INDEX IDX_29A5EC2738989DF4 (ligne_panier_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE produit ADD CONSTRAINT FK_29A5EC279F34925F FOREIGN KEY (id_categorie_id) REFERENCES categorie (id)');
        $this->addSql('ALTER TABLE produit ADD CONSTRAINT FK_29A5EC2738989DF4 FOREIGN KEY (ligne_panier_id) REFERENCES ligne_panier (id)');
        $this->addSql('ALTER TABLE panier ADD ligne_panier_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE panier ADD CONSTRAINT FK_24CC0DF238989DF4 FOREIGN KEY (ligne_panier_id) REFERENCES ligne_panier (id)');
        $this->addSql('CREATE INDEX IDX_24CC0DF238989DF4 ON panier (ligne_panier_id)');
        $this->addSql('ALTER TABLE vendeur ADD produit_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE vendeur ADD CONSTRAINT FK_7AF49996F347EFB FOREIGN KEY (produit_id) REFERENCES produit (id)');
        $this->addSql('CREATE INDEX IDX_7AF49996F347EFB ON vendeur (produit_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE panier DROP FOREIGN KEY FK_24CC0DF238989DF4');
        $this->addSql('ALTER TABLE vendeur DROP FOREIGN KEY FK_7AF49996F347EFB');
        $this->addSql('ALTER TABLE produit DROP FOREIGN KEY FK_29A5EC279F34925F');
        $this->addSql('ALTER TABLE produit DROP FOREIGN KEY FK_29A5EC2738989DF4');
        $this->addSql('DROP TABLE ligne_panier');
        $this->addSql('DROP TABLE produit');
        $this->addSql('DROP INDEX IDX_24CC0DF238989DF4 ON panier');
        $this->addSql('ALTER TABLE panier DROP ligne_panier_id');
        $this->addSql('DROP INDEX IDX_7AF49996F347EFB ON vendeur');
        $this->addSql('ALTER TABLE vendeur DROP produit_id');
    }
}
