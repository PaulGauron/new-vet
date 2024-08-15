<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240814170836 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE admin (id INT NOT NULL, acces TINYINT(1) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE adresse (id INT AUTO_INCREMENT NOT NULL, libelle_voie VARCHAR(255) NOT NULL, code_postal INT NOT NULL, ville VARCHAR(100) NOT NULL, type_adresse VARCHAR(50) NOT NULL, preference VARCHAR(50) NOT NULL, pays VARCHAR(50) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE adresse_client (id_utilisateur_id INT NOT NULL, id_adresse_id INT NOT NULL, INDEX IDX_891D1BDC6EE5C49 (id_utilisateur_id), INDEX IDX_891D1BDE86D5C8B (id_adresse_id), PRIMARY KEY(id_utilisateur_id, id_adresse_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE categorie (id INT AUTO_INCREMENT NOT NULL, nom_cat VARCHAR(50) NOT NULL, description VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE client (id INT NOT NULL, methode_paiement VARCHAR(50) NOT NULL, nom_carte VARCHAR(50) NOT NULL, numero_carte VARCHAR(255) NOT NULL, date_expiration_carte VARCHAR(255) NOT NULL, cvv VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE commandes (id INT AUTO_INCREMENT NOT NULL, id_util_id INT NOT NULL, adresse_id INT NOT NULL, INDEX IDX_35D4282C11C087F0 (id_util_id), INDEX IDX_35D4282C4DE7DC5C (adresse_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE contact (id INT AUTO_INCREMENT NOT NULL, id_util_id INT NOT NULL, sujet VARCHAR(255) NOT NULL, contenu VARCHAR(255) NOT NULL, date_contact DATE NOT NULL, INDEX IDX_4C62E63811C087F0 (id_util_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE detail_commande (id INT AUTO_INCREMENT NOT NULL, id_com_id INT NOT NULL, date_commande DATE NOT NULL, quantite INT NOT NULL, prix_tot DOUBLE PRECISION NOT NULL, INDEX IDX_98344FA652BBBADA (id_com_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE images (id INT AUTO_INCREMENT NOT NULL, id_prod_id INT NOT NULL, INDEX IDX_E01FBE6ADF559605 (id_prod_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE materiaux (id INT AUTO_INCREMENT NOT NULL, nom__mat VARCHAR(50) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE produit (id INT AUTO_INCREMENT NOT NULL, categorie_id INT NOT NULL, nom_prod VARCHAR(50) NOT NULL, description_prod VARCHAR(255) NOT NULL, prix_prod DOUBLE PRECISION NOT NULL, stock INT NOT NULL, disponibilite SMALLINT NOT NULL, INDEX IDX_29A5EC27BCF5E72D (categorie_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE produit_commandes (id_commande_id INT NOT NULL, id_produit_id INT NOT NULL, prix_calcul DOUBLE PRECISION NOT NULL, quantite INT NOT NULL, INDEX IDX_B14376C09AF8E3A3 (id_commande_id), INDEX IDX_B14376C0AABEFE2C (id_produit_id), PRIMARY KEY(id_commande_id, id_produit_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE produit_materiaux (id INT AUTO_INCREMENT NOT NULL, id_materiaux_id INT NOT NULL, id_produit_id INT NOT NULL, INDEX IDX_135238C9A3AFCEC0 (id_materiaux_id), INDEX IDX_135238C9AABEFE2C (id_produit_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE utilisateur (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, prenom VARCHAR(255) NOT NULL, email VARCHAR(255) NOT NULL, mdp VARCHAR(255) NOT NULL, telephone INT NOT NULL, dtype VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', available_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', delivered_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_75EA56E0FB7336F0 (queue_name), INDEX IDX_75EA56E0E3BD61CE (available_at), INDEX IDX_75EA56E016BA31DB (delivered_at), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE admin ADD CONSTRAINT FK_880E0D76BF396750 FOREIGN KEY (id) REFERENCES utilisateur (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE adresse_client ADD CONSTRAINT FK_891D1BDC6EE5C49 FOREIGN KEY (id_utilisateur_id) REFERENCES client (id)');
        $this->addSql('ALTER TABLE adresse_client ADD CONSTRAINT FK_891D1BDE86D5C8B FOREIGN KEY (id_adresse_id) REFERENCES adresse (id)');
        $this->addSql('ALTER TABLE client ADD CONSTRAINT FK_C7440455BF396750 FOREIGN KEY (id) REFERENCES utilisateur (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE commandes ADD CONSTRAINT FK_35D4282C11C087F0 FOREIGN KEY (id_util_id) REFERENCES utilisateur (id)');
        $this->addSql('ALTER TABLE commandes ADD CONSTRAINT FK_35D4282C4DE7DC5C FOREIGN KEY (adresse_id) REFERENCES adresse (id)');
        $this->addSql('ALTER TABLE contact ADD CONSTRAINT FK_4C62E63811C087F0 FOREIGN KEY (id_util_id) REFERENCES utilisateur (id)');
        $this->addSql('ALTER TABLE detail_commande ADD CONSTRAINT FK_98344FA652BBBADA FOREIGN KEY (id_com_id) REFERENCES commandes (id)');
        $this->addSql('ALTER TABLE images ADD CONSTRAINT FK_E01FBE6ADF559605 FOREIGN KEY (id_prod_id) REFERENCES produit (id)');
        $this->addSql('ALTER TABLE produit ADD CONSTRAINT FK_29A5EC27BCF5E72D FOREIGN KEY (categorie_id) REFERENCES categorie (id)');
        $this->addSql('ALTER TABLE produit_commandes ADD CONSTRAINT FK_B14376C09AF8E3A3 FOREIGN KEY (id_commande_id) REFERENCES commandes (id)');
        $this->addSql('ALTER TABLE produit_commandes ADD CONSTRAINT FK_B14376C0AABEFE2C FOREIGN KEY (id_produit_id) REFERENCES produit (id)');
        $this->addSql('ALTER TABLE produit_materiaux ADD CONSTRAINT FK_135238C9A3AFCEC0 FOREIGN KEY (id_materiaux_id) REFERENCES materiaux (id)');
        $this->addSql('ALTER TABLE produit_materiaux ADD CONSTRAINT FK_135238C9AABEFE2C FOREIGN KEY (id_produit_id) REFERENCES produit (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE admin DROP FOREIGN KEY FK_880E0D76BF396750');
        $this->addSql('ALTER TABLE adresse_client DROP FOREIGN KEY FK_891D1BDC6EE5C49');
        $this->addSql('ALTER TABLE adresse_client DROP FOREIGN KEY FK_891D1BDE86D5C8B');
        $this->addSql('ALTER TABLE client DROP FOREIGN KEY FK_C7440455BF396750');
        $this->addSql('ALTER TABLE commandes DROP FOREIGN KEY FK_35D4282C11C087F0');
        $this->addSql('ALTER TABLE commandes DROP FOREIGN KEY FK_35D4282C4DE7DC5C');
        $this->addSql('ALTER TABLE contact DROP FOREIGN KEY FK_4C62E63811C087F0');
        $this->addSql('ALTER TABLE detail_commande DROP FOREIGN KEY FK_98344FA652BBBADA');
        $this->addSql('ALTER TABLE images DROP FOREIGN KEY FK_E01FBE6ADF559605');
        $this->addSql('ALTER TABLE produit DROP FOREIGN KEY FK_29A5EC27BCF5E72D');
        $this->addSql('ALTER TABLE produit_commandes DROP FOREIGN KEY FK_B14376C09AF8E3A3');
        $this->addSql('ALTER TABLE produit_commandes DROP FOREIGN KEY FK_B14376C0AABEFE2C');
        $this->addSql('ALTER TABLE produit_materiaux DROP FOREIGN KEY FK_135238C9A3AFCEC0');
        $this->addSql('ALTER TABLE produit_materiaux DROP FOREIGN KEY FK_135238C9AABEFE2C');
        $this->addSql('DROP TABLE admin');
        $this->addSql('DROP TABLE adresse');
        $this->addSql('DROP TABLE adresse_client');
        $this->addSql('DROP TABLE categorie');
        $this->addSql('DROP TABLE client');
        $this->addSql('DROP TABLE commandes');
        $this->addSql('DROP TABLE contact');
        $this->addSql('DROP TABLE detail_commande');
        $this->addSql('DROP TABLE images');
        $this->addSql('DROP TABLE materiaux');
        $this->addSql('DROP TABLE produit');
        $this->addSql('DROP TABLE produit_commandes');
        $this->addSql('DROP TABLE produit_materiaux');
        $this->addSql('DROP TABLE utilisateur');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
