<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240619090002 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE adresse_client (id_utilisateur_id INT NOT NULL, id_adresse_id INT NOT NULL, INDEX IDX_891D1BDC6EE5C49 (id_utilisateur_id), INDEX IDX_891D1BDE86D5C8B (id_adresse_id), PRIMARY KEY(id_utilisateur_id, id_adresse_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE adresse_commandes (id_commandes_id INT NOT NULL, id_adresse_id INT NOT NULL, INDEX IDX_98D3BEFAA834B794 (id_commandes_id), INDEX IDX_98D3BEFAE86D5C8B (id_adresse_id), PRIMARY KEY(id_commandes_id, id_adresse_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE images (id INT AUTO_INCREMENT NOT NULL, id_prod_id INT NOT NULL, INDEX IDX_E01FBE6ADF559605 (id_prod_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE produit_commandes (id_commande_id INT NOT NULL, id_produit_id INT NOT NULL, prix_calcul DOUBLE PRECISION NOT NULL, quantite INT NOT NULL, INDEX IDX_B14376C09AF8E3A3 (id_commande_id), INDEX IDX_B14376C0AABEFE2C (id_produit_id), PRIMARY KEY(id_commande_id, id_produit_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE produit_materiaux (id INT AUTO_INCREMENT NOT NULL, id_materiaux_id INT NOT NULL, id_produit_id INT NOT NULL, INDEX IDX_135238C9A3AFCEC0 (id_materiaux_id), INDEX IDX_135238C9AABEFE2C (id_produit_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE adresse_client ADD CONSTRAINT FK_891D1BDC6EE5C49 FOREIGN KEY (id_utilisateur_id) REFERENCES client (id)');
        $this->addSql('ALTER TABLE adresse_client ADD CONSTRAINT FK_891D1BDE86D5C8B FOREIGN KEY (id_adresse_id) REFERENCES adresse (id)');
        $this->addSql('ALTER TABLE adresse_commandes ADD CONSTRAINT FK_98D3BEFAA834B794 FOREIGN KEY (id_commandes_id) REFERENCES commandes (id)');
        $this->addSql('ALTER TABLE adresse_commandes ADD CONSTRAINT FK_98D3BEFAE86D5C8B FOREIGN KEY (id_adresse_id) REFERENCES adresse (id)');
        $this->addSql('ALTER TABLE images ADD CONSTRAINT FK_E01FBE6ADF559605 FOREIGN KEY (id_prod_id) REFERENCES produit (id)');
        $this->addSql('ALTER TABLE produit_commandes ADD CONSTRAINT FK_B14376C09AF8E3A3 FOREIGN KEY (id_commande_id) REFERENCES commandes (id)');
        $this->addSql('ALTER TABLE produit_commandes ADD CONSTRAINT FK_B14376C0AABEFE2C FOREIGN KEY (id_produit_id) REFERENCES produit (id)');
        $this->addSql('ALTER TABLE produit_materiaux ADD CONSTRAINT FK_135238C9A3AFCEC0 FOREIGN KEY (id_materiaux_id) REFERENCES materiaux (id)');
        $this->addSql('ALTER TABLE produit_materiaux ADD CONSTRAINT FK_135238C9AABEFE2C FOREIGN KEY (id_produit_id) REFERENCES produit (id)');
        $this->addSql('DROP TABLE concerner');
        $this->addSql('DROP TABLE correspond');
        $this->addSql('DROP TABLE enregistre');
        $this->addSql('DROP TABLE image');
        $this->addSql('DROP TABLE lier');
        $this->addSql('DROP TABLE utiliser');
        $this->addSql('DROP INDEX `primary` ON admin');
        $this->addSql('ALTER TABLE admin CHANGE id_utilisateur id INT NOT NULL, CHANGE access acces TINYINT(1) NOT NULL');
        $this->addSql('ALTER TABLE admin ADD CONSTRAINT FK_880E0D76BF396750 FOREIGN KEY (id) REFERENCES utilisateur (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE admin ADD PRIMARY KEY (id)');
        $this->addSql('ALTER TABLE adresse ADD pays VARCHAR(50) NOT NULL, DROP id_adresse, CHANGE ville ville VARCHAR(100) NOT NULL, CHANGE type_adresse type_adresse VARCHAR(50) NOT NULL, CHANGE preference preference VARCHAR(50) NOT NULL');
        $this->addSql('ALTER TABLE categorie DROP id_categorie, DROP id_images, CHANGE nom_cat nom_cat VARCHAR(50) NOT NULL');
        $this->addSql('ALTER TABLE client CHANGE methode_paiement methode_paiement VARCHAR(50) NOT NULL, CHANGE nom_carte nom_carte VARCHAR(50) NOT NULL');
        $this->addSql('ALTER TABLE commandes ADD id_util_id INT NOT NULL, DROP id_commandes, DROP id_utilisateur');
        $this->addSql('ALTER TABLE commandes ADD CONSTRAINT FK_35D4282C11C087F0 FOREIGN KEY (id_util_id) REFERENCES utilisateur (id)');
        $this->addSql('CREATE INDEX IDX_35D4282C11C087F0 ON commandes (id_util_id)');
        $this->addSql('ALTER TABLE contact ADD id_util_id INT NOT NULL, DROP id_contact, DROP id_utilisateur, CHANGE sujet sujet VARCHAR(255) NOT NULL, CHANGE texte contenu VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE contact ADD CONSTRAINT FK_4C62E63811C087F0 FOREIGN KEY (id_util_id) REFERENCES utilisateur (id)');
        $this->addSql('CREATE INDEX IDX_4C62E63811C087F0 ON contact (id_util_id)');
        $this->addSql('ALTER TABLE detail_commande ADD id_com_id INT NOT NULL, ADD quantite INT NOT NULL, DROP id_detail_commande, DROP id_commandes, CHANGE prix_tot prix_tot DOUBLE PRECISION NOT NULL');
        $this->addSql('ALTER TABLE detail_commande ADD CONSTRAINT FK_98344FA652BBBADA FOREIGN KEY (id_com_id) REFERENCES commandes (id)');
        $this->addSql('CREATE INDEX IDX_98344FA652BBBADA ON detail_commande (id_com_id)');
        $this->addSql('ALTER TABLE materiaux ADD nom__mat VARCHAR(50) NOT NULL, DROP id_materiaux, DROP nom_mat');
        $this->addSql('ALTER TABLE produit ADD stock INT NOT NULL, DROP id_produit, DROP en_stock, CHANGE nom_prod nom_prod VARCHAR(50) NOT NULL');
        $this->addSql('ALTER TABLE utilisateur CHANGE nom nom VARCHAR(255) NOT NULL, CHANGE prenom prenom VARCHAR(255) NOT NULL, CHANGE email email VARCHAR(255) NOT NULL, CHANGE id_utilisateur telephone INT NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE concerner (id INT AUTO_INCREMENT NOT NULL, id_produit INT NOT NULL, id_commandes INT NOT NULL, prix_calcul DOUBLE PRECISION NOT NULL, quantite INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE correspond (id INT AUTO_INCREMENT NOT NULL, id_commande INT NOT NULL, id_adresse INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE enregistre (id INT AUTO_INCREMENT NOT NULL, id_utilisateur INT NOT NULL, id_adresse INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE image (id INT AUTO_INCREMENT NOT NULL, id_images INT NOT NULL, id_produit INT DEFAULT NULL, code VARCHAR(6) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE lier (id INT AUTO_INCREMENT NOT NULL, id_categorie INT NOT NULL, id_produit INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE utiliser (id INT AUTO_INCREMENT NOT NULL, id_produit INT NOT NULL, id_materiaux INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE adresse_client DROP FOREIGN KEY FK_891D1BDC6EE5C49');
        $this->addSql('ALTER TABLE adresse_client DROP FOREIGN KEY FK_891D1BDE86D5C8B');
        $this->addSql('ALTER TABLE adresse_commandes DROP FOREIGN KEY FK_98D3BEFAA834B794');
        $this->addSql('ALTER TABLE adresse_commandes DROP FOREIGN KEY FK_98D3BEFAE86D5C8B');
        $this->addSql('ALTER TABLE images DROP FOREIGN KEY FK_E01FBE6ADF559605');
        $this->addSql('ALTER TABLE produit_commandes DROP FOREIGN KEY FK_B14376C09AF8E3A3');
        $this->addSql('ALTER TABLE produit_commandes DROP FOREIGN KEY FK_B14376C0AABEFE2C');
        $this->addSql('ALTER TABLE produit_materiaux DROP FOREIGN KEY FK_135238C9A3AFCEC0');
        $this->addSql('ALTER TABLE produit_materiaux DROP FOREIGN KEY FK_135238C9AABEFE2C');
        $this->addSql('DROP TABLE adresse_client');
        $this->addSql('DROP TABLE adresse_commandes');
        $this->addSql('DROP TABLE images');
        $this->addSql('DROP TABLE produit_commandes');
        $this->addSql('DROP TABLE produit_materiaux');
        $this->addSql('ALTER TABLE admin DROP FOREIGN KEY FK_880E0D76BF396750');
        $this->addSql('DROP INDEX `PRIMARY` ON admin');
        $this->addSql('ALTER TABLE admin CHANGE id id_utilisateur INT NOT NULL, CHANGE acces access TINYINT(1) NOT NULL');
        $this->addSql('ALTER TABLE admin ADD PRIMARY KEY (id_utilisateur)');
        $this->addSql('ALTER TABLE adresse ADD id_adresse INT NOT NULL, DROP pays, CHANGE ville ville VARCHAR(255) NOT NULL, CHANGE type_adresse type_adresse VARCHAR(255) NOT NULL, CHANGE preference preference VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE categorie ADD id_categorie INT NOT NULL, ADD id_images INT NOT NULL, CHANGE nom_cat nom_cat VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE client CHANGE methode_paiement methode_paiement VARCHAR(255) NOT NULL, CHANGE nom_carte nom_carte VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE commandes DROP FOREIGN KEY FK_35D4282C11C087F0');
        $this->addSql('DROP INDEX IDX_35D4282C11C087F0 ON commandes');
        $this->addSql('ALTER TABLE commandes ADD id_utilisateur INT NOT NULL, CHANGE id_util_id id_commandes INT NOT NULL');
        $this->addSql('ALTER TABLE contact DROP FOREIGN KEY FK_4C62E63811C087F0');
        $this->addSql('DROP INDEX IDX_4C62E63811C087F0 ON contact');
        $this->addSql('ALTER TABLE contact ADD id_utilisateur INT NOT NULL, CHANGE sujet sujet VARCHAR(100) NOT NULL, CHANGE id_util_id id_contact INT NOT NULL, CHANGE contenu texte VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE detail_commande DROP FOREIGN KEY FK_98344FA652BBBADA');
        $this->addSql('DROP INDEX IDX_98344FA652BBBADA ON detail_commande');
        $this->addSql('ALTER TABLE detail_commande ADD id_detail_commande INT NOT NULL, ADD id_commandes INT NOT NULL, DROP id_com_id, DROP quantite, CHANGE prix_tot prix_tot INT NOT NULL');
        $this->addSql('ALTER TABLE materiaux ADD id_materiaux INT NOT NULL, ADD nom_mat VARCHAR(255) NOT NULL, DROP nom__mat');
        $this->addSql('ALTER TABLE produit ADD en_stock INT NOT NULL, CHANGE nom_prod nom_prod VARCHAR(255) NOT NULL, CHANGE stock id_produit INT NOT NULL');
        $this->addSql('ALTER TABLE utilisateur CHANGE nom nom VARCHAR(50) NOT NULL, CHANGE prenom prenom VARCHAR(50) NOT NULL, CHANGE email email VARCHAR(150) NOT NULL, CHANGE telephone id_utilisateur INT NOT NULL');
    }
}
