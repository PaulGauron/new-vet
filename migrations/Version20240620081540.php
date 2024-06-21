<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240620081540 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE admin (id INT NOT NULL, acces TINYINT(1) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE adresse_client (id_utilisateur_id INT NOT NULL, id_adresse_id INT NOT NULL, INDEX IDX_891D1BDC6EE5C49 (id_utilisateur_id), INDEX IDX_891D1BDE86D5C8B (id_adresse_id), PRIMARY KEY(id_utilisateur_id, id_adresse_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE adresse_commandes (id_commandes_id INT NOT NULL, id_adresse_id INT NOT NULL, INDEX IDX_98D3BEFAA834B794 (id_commandes_id), INDEX IDX_98D3BEFAE86D5C8B (id_adresse_id), PRIMARY KEY(id_commandes_id, id_adresse_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE produit_commandes (id_commande_id INT NOT NULL, id_produit_id INT NOT NULL, prix_calcul DOUBLE PRECISION NOT NULL, quantite INT NOT NULL, INDEX IDX_B14376C09AF8E3A3 (id_commande_id), INDEX IDX_B14376C0AABEFE2C (id_produit_id), PRIMARY KEY(id_commande_id, id_produit_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE produit_materiaux (id INT AUTO_INCREMENT NOT NULL, id_materiaux_id INT NOT NULL, id_produit_id INT NOT NULL, INDEX IDX_135238C9A3AFCEC0 (id_materiaux_id), INDEX IDX_135238C9AABEFE2C (id_produit_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', available_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', delivered_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_75EA56E0FB7336F0 (queue_name), INDEX IDX_75EA56E0E3BD61CE (available_at), INDEX IDX_75EA56E016BA31DB (delivered_at), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE admin ADD CONSTRAINT FK_880E0D76BF396750 FOREIGN KEY (id) REFERENCES utilisateur (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE adresse_client ADD CONSTRAINT FK_891D1BDC6EE5C49 FOREIGN KEY (id_utilisateur_id) REFERENCES client (id)');
        $this->addSql('ALTER TABLE adresse_client ADD CONSTRAINT FK_891D1BDE86D5C8B FOREIGN KEY (id_adresse_id) REFERENCES adresse (id)');
        $this->addSql('ALTER TABLE adresse_commandes ADD CONSTRAINT FK_98D3BEFAA834B794 FOREIGN KEY (id_commandes_id) REFERENCES commandes (id)');
        $this->addSql('ALTER TABLE adresse_commandes ADD CONSTRAINT FK_98D3BEFAE86D5C8B FOREIGN KEY (id_adresse_id) REFERENCES adresse (id)');
        $this->addSql('ALTER TABLE produit_commandes ADD CONSTRAINT FK_B14376C09AF8E3A3 FOREIGN KEY (id_commande_id) REFERENCES commandes (id)');
        $this->addSql('ALTER TABLE produit_commandes ADD CONSTRAINT FK_B14376C0AABEFE2C FOREIGN KEY (id_produit_id) REFERENCES produit (id)');
        $this->addSql('ALTER TABLE produit_materiaux ADD CONSTRAINT FK_135238C9A3AFCEC0 FOREIGN KEY (id_materiaux_id) REFERENCES materiaux (id)');
        $this->addSql('ALTER TABLE produit_materiaux ADD CONSTRAINT FK_135238C9AABEFE2C FOREIGN KEY (id_produit_id) REFERENCES produit (id)');
        $this->addSql('ALTER TABLE autre DROP FOREIGN KEY autre_ibfk_1');
        $this->addSql('ALTER TABLE concerner DROP FOREIGN KEY concerner_ibfk_1');
        $this->addSql('ALTER TABLE concerner DROP FOREIGN KEY concerner_ibfk_2');
        $this->addSql('ALTER TABLE correspond DROP FOREIGN KEY correspond_ibfk_1');
        $this->addSql('ALTER TABLE correspond DROP FOREIGN KEY correspond_ibfk_2');
        $this->addSql('ALTER TABLE enregistre DROP FOREIGN KEY enregistre_ibfk_2');
        $this->addSql('ALTER TABLE enregistre DROP FOREIGN KEY enregistre_ibfk_1');
        $this->addSql('ALTER TABLE lier DROP FOREIGN KEY lier_ibfk_2');
        $this->addSql('ALTER TABLE lier DROP FOREIGN KEY lier_ibfk_1');
        $this->addSql('ALTER TABLE utiliser DROP FOREIGN KEY utiliser_ibfk_1');
        $this->addSql('ALTER TABLE utiliser DROP FOREIGN KEY utiliser_ibfk_2');
        $this->addSql('DROP TABLE autre');
        $this->addSql('DROP TABLE concerner');
        $this->addSql('DROP TABLE correspond');
        $this->addSql('DROP TABLE enregistre');
        $this->addSql('DROP TABLE lier');
        $this->addSql('DROP TABLE utiliser');
        $this->addSql('ALTER TABLE adresse MODIFY Id_adresse INT NOT NULL');
        $this->addSql('DROP INDEX `primary` ON adresse');
        $this->addSql('ALTER TABLE adresse ADD pays VARCHAR(50) NOT NULL, CHANGE libelle_voie libelle_voie VARCHAR(255) NOT NULL, CHANGE code_postal code_postal INT NOT NULL, CHANGE ville ville VARCHAR(100) NOT NULL, CHANGE type_adresse type_adresse VARCHAR(50) NOT NULL, CHANGE Id_adresse id INT AUTO_INCREMENT NOT NULL');
        $this->addSql('ALTER TABLE adresse ADD PRIMARY KEY (id)');
        $this->addSql('ALTER TABLE categorie MODIFY Id_categorie INT NOT NULL');
        $this->addSql('ALTER TABLE categorie DROP FOREIGN KEY fk_image_cat');
        $this->addSql('DROP INDEX fk_image_cat ON categorie');
        $this->addSql('DROP INDEX `primary` ON categorie');
        $this->addSql('ALTER TABLE categorie DROP Id_images, CHANGE nom_cat nom_cat VARCHAR(50) NOT NULL, CHANGE description description VARCHAR(255) NOT NULL, CHANGE Id_categorie id INT AUTO_INCREMENT NOT NULL');
        $this->addSql('ALTER TABLE categorie ADD PRIMARY KEY (id)');
        $this->addSql('ALTER TABLE client DROP FOREIGN KEY client_ibfk_1');
        $this->addSql('DROP INDEX `primary` ON client');
        $this->addSql('ALTER TABLE client ADD methode_paiement VARCHAR(50) NOT NULL, DROP methode_paiment, CHANGE nom_carte nom_carte VARCHAR(50) NOT NULL, CHANGE numero_carte numero_carte VARCHAR(255) NOT NULL, CHANGE date_expiration_carte date_expiration_carte VARCHAR(255) NOT NULL, CHANGE CVV cvv VARCHAR(255) NOT NULL, CHANGE Id_utilisateur id INT NOT NULL');
        $this->addSql('ALTER TABLE client ADD CONSTRAINT FK_C7440455BF396750 FOREIGN KEY (id) REFERENCES utilisateur (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE client ADD PRIMARY KEY (id)');
        $this->addSql('ALTER TABLE commandes MODIFY Id_commandes INT NOT NULL');
        $this->addSql('ALTER TABLE commandes DROP FOREIGN KEY commandes_ibfk_1');
        $this->addSql('DROP INDEX Id_utilisateur ON commandes');
        $this->addSql('DROP INDEX `primary` ON commandes');
        $this->addSql('ALTER TABLE commandes CHANGE Id_commandes id INT AUTO_INCREMENT NOT NULL, CHANGE Id_utilisateur id_util_id INT NOT NULL');
        $this->addSql('ALTER TABLE commandes ADD CONSTRAINT FK_35D4282C11C087F0 FOREIGN KEY (id_util_id) REFERENCES utilisateur (id)');
        $this->addSql('CREATE INDEX IDX_35D4282C11C087F0 ON commandes (id_util_id)');
        $this->addSql('ALTER TABLE commandes ADD PRIMARY KEY (id)');
        $this->addSql('ALTER TABLE contact MODIFY Id_contact INT NOT NULL');
        $this->addSql('ALTER TABLE contact DROP FOREIGN KEY contact_ibfk_1');
        $this->addSql('DROP INDEX Id_utilisateur ON contact');
        $this->addSql('DROP INDEX `primary` ON contact');
        $this->addSql('ALTER TABLE contact ADD contenu VARCHAR(255) NOT NULL, DROP texte, DROP email, CHANGE sujet sujet VARCHAR(255) NOT NULL, CHANGE date_contact date_contact DATE NOT NULL, CHANGE Id_contact id INT AUTO_INCREMENT NOT NULL, CHANGE Id_utilisateur id_util_id INT NOT NULL');
        $this->addSql('ALTER TABLE contact ADD CONSTRAINT FK_4C62E63811C087F0 FOREIGN KEY (id_util_id) REFERENCES utilisateur (id)');
        $this->addSql('CREATE INDEX IDX_4C62E63811C087F0 ON contact (id_util_id)');
        $this->addSql('ALTER TABLE contact ADD PRIMARY KEY (id)');
        $this->addSql('ALTER TABLE detail_commande MODIFY Id_detail_commande INT NOT NULL');
        $this->addSql('ALTER TABLE detail_commande DROP FOREIGN KEY detail_commande_ibfk_1');
        $this->addSql('DROP INDEX Id_commandes ON detail_commande');
        $this->addSql('DROP INDEX `primary` ON detail_commande');
        $this->addSql('ALTER TABLE detail_commande ADD quantite INT NOT NULL, CHANGE date_commande date_commande DATE NOT NULL, CHANGE prix_tot prix_tot DOUBLE PRECISION NOT NULL, CHANGE Id_detail_commande id INT AUTO_INCREMENT NOT NULL, CHANGE Id_commandes id_com_id INT NOT NULL');
        $this->addSql('ALTER TABLE detail_commande ADD CONSTRAINT FK_98344FA652BBBADA FOREIGN KEY (id_com_id) REFERENCES commandes (id)');
        $this->addSql('CREATE INDEX IDX_98344FA652BBBADA ON detail_commande (id_com_id)');
        $this->addSql('ALTER TABLE detail_commande ADD PRIMARY KEY (id)');
        $this->addSql('ALTER TABLE images MODIFY Id_images INT NOT NULL');
        $this->addSql('ALTER TABLE images DROP FOREIGN KEY images_ibfk_1');
        $this->addSql('DROP INDEX Id_produit ON images');
        $this->addSql('DROP INDEX `primary` ON images');
        $this->addSql('ALTER TABLE images ADD id_prod_id INT NOT NULL, DROP Id_produit, DROP code, CHANGE Id_images id INT AUTO_INCREMENT NOT NULL');
        $this->addSql('ALTER TABLE images ADD CONSTRAINT FK_E01FBE6ADF559605 FOREIGN KEY (id_prod_id) REFERENCES produit (id)');
        $this->addSql('CREATE INDEX IDX_E01FBE6ADF559605 ON images (id_prod_id)');
        $this->addSql('ALTER TABLE images ADD PRIMARY KEY (id)');
        $this->addSql('ALTER TABLE materiaux MODIFY Id_materiaux INT NOT NULL');
        $this->addSql('DROP INDEX `primary` ON materiaux');
        $this->addSql('ALTER TABLE materiaux ADD nom__mat VARCHAR(50) NOT NULL, DROP nom_mat, CHANGE Id_materiaux id INT AUTO_INCREMENT NOT NULL');
        $this->addSql('ALTER TABLE materiaux ADD PRIMARY KEY (id)');
        $this->addSql('ALTER TABLE produit MODIFY Id_produit INT NOT NULL');
        $this->addSql('DROP INDEX `primary` ON produit');
        $this->addSql('ALTER TABLE produit ADD stock INT NOT NULL, DROP en_stock, CHANGE nom_prod nom_prod VARCHAR(50) NOT NULL, CHANGE description_prod description_prod VARCHAR(255) NOT NULL, CHANGE prix_prod prix_prod DOUBLE PRECISION NOT NULL, CHANGE disponibilite disponibilite SMALLINT NOT NULL, CHANGE Id_produit id INT AUTO_INCREMENT NOT NULL');
        $this->addSql('ALTER TABLE produit ADD PRIMARY KEY (id)');
        $this->addSql('ALTER TABLE utilisateur MODIFY Id_utilisateur INT NOT NULL');
        $this->addSql('DROP INDEX `primary` ON utilisateur');
        $this->addSql('ALTER TABLE utilisateur ADD telephone INT NOT NULL, ADD dtype VARCHAR(255) NOT NULL, CHANGE nom nom VARCHAR(255) NOT NULL, CHANGE prenom prenom VARCHAR(255) NOT NULL, CHANGE email email VARCHAR(255) NOT NULL, CHANGE mdp mdp VARCHAR(255) NOT NULL, CHANGE Id_utilisateur id INT AUTO_INCREMENT NOT NULL');
        $this->addSql('ALTER TABLE utilisateur ADD PRIMARY KEY (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE autre (Id_utilisateur INT NOT NULL, PRIMARY KEY(Id_utilisateur)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_general_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE concerner (Id_produit INT NOT NULL, Id_commandes INT NOT NULL, prix_calcul DOUBLE PRECISION NOT NULL, quantite INT DEFAULT NULL, INDEX Id_commandes (Id_commandes), INDEX IDX_ABE9A866B8654687 (Id_produit), PRIMARY KEY(Id_produit, Id_commandes)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_general_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE correspond (Id_commandes INT NOT NULL, Id_adresse INT NOT NULL, INDEX Id_adresse (Id_adresse), INDEX IDX_B05C0580ADD04FF3 (Id_commandes), PRIMARY KEY(Id_commandes, Id_adresse)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_general_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE enregistre (Id_utilisateur INT NOT NULL, Id_adresse INT NOT NULL, INDEX Id_adresse (Id_adresse), INDEX IDX_FC6E6358C86AD69C (Id_utilisateur), PRIMARY KEY(Id_utilisateur, Id_adresse)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_general_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE lier (Id_categorie INT NOT NULL, Id_produit INT NOT NULL, INDEX Id_produit (Id_produit), INDEX IDX_B133E8FAD179B1EB (Id_categorie), PRIMARY KEY(Id_categorie, Id_produit)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_general_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE utiliser (Id_produit INT NOT NULL, Id_materiaux INT NOT NULL, INDEX Id_materiaux (Id_materiaux), INDEX IDX_5C949109B8654687 (Id_produit), PRIMARY KEY(Id_produit, Id_materiaux)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_general_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE autre ADD CONSTRAINT autre_ibfk_1 FOREIGN KEY (Id_utilisateur) REFERENCES utilisateur (Id_utilisateur)');
        $this->addSql('ALTER TABLE concerner ADD CONSTRAINT concerner_ibfk_1 FOREIGN KEY (Id_produit) REFERENCES produit (Id_produit)');
        $this->addSql('ALTER TABLE concerner ADD CONSTRAINT concerner_ibfk_2 FOREIGN KEY (Id_commandes) REFERENCES commandes (Id_commandes)');
        $this->addSql('ALTER TABLE correspond ADD CONSTRAINT correspond_ibfk_1 FOREIGN KEY (Id_commandes) REFERENCES commandes (Id_commandes)');
        $this->addSql('ALTER TABLE correspond ADD CONSTRAINT correspond_ibfk_2 FOREIGN KEY (Id_adresse) REFERENCES adresse (Id_adresse)');
        $this->addSql('ALTER TABLE enregistre ADD CONSTRAINT enregistre_ibfk_2 FOREIGN KEY (Id_adresse) REFERENCES adresse (Id_adresse)');
        $this->addSql('ALTER TABLE enregistre ADD CONSTRAINT enregistre_ibfk_1 FOREIGN KEY (Id_utilisateur) REFERENCES client (Id_utilisateur)');
        $this->addSql('ALTER TABLE lier ADD CONSTRAINT lier_ibfk_2 FOREIGN KEY (Id_produit) REFERENCES produit (Id_produit)');
        $this->addSql('ALTER TABLE lier ADD CONSTRAINT lier_ibfk_1 FOREIGN KEY (Id_categorie) REFERENCES categorie (Id_categorie)');
        $this->addSql('ALTER TABLE utiliser ADD CONSTRAINT utiliser_ibfk_1 FOREIGN KEY (Id_produit) REFERENCES produit (Id_produit)');
        $this->addSql('ALTER TABLE utiliser ADD CONSTRAINT utiliser_ibfk_2 FOREIGN KEY (Id_materiaux) REFERENCES materiaux (Id_materiaux)');
        $this->addSql('ALTER TABLE admin DROP FOREIGN KEY FK_880E0D76BF396750');
        $this->addSql('ALTER TABLE adresse_client DROP FOREIGN KEY FK_891D1BDC6EE5C49');
        $this->addSql('ALTER TABLE adresse_client DROP FOREIGN KEY FK_891D1BDE86D5C8B');
        $this->addSql('ALTER TABLE adresse_commandes DROP FOREIGN KEY FK_98D3BEFAA834B794');
        $this->addSql('ALTER TABLE adresse_commandes DROP FOREIGN KEY FK_98D3BEFAE86D5C8B');
        $this->addSql('ALTER TABLE produit_commandes DROP FOREIGN KEY FK_B14376C09AF8E3A3');
        $this->addSql('ALTER TABLE produit_commandes DROP FOREIGN KEY FK_B14376C0AABEFE2C');
        $this->addSql('ALTER TABLE produit_materiaux DROP FOREIGN KEY FK_135238C9A3AFCEC0');
        $this->addSql('ALTER TABLE produit_materiaux DROP FOREIGN KEY FK_135238C9AABEFE2C');
        $this->addSql('DROP TABLE admin');
        $this->addSql('DROP TABLE adresse_client');
        $this->addSql('DROP TABLE adresse_commandes');
        $this->addSql('DROP TABLE produit_commandes');
        $this->addSql('DROP TABLE produit_materiaux');
        $this->addSql('DROP TABLE messenger_messages');
        $this->addSql('ALTER TABLE adresse MODIFY id INT NOT NULL');
        $this->addSql('DROP INDEX `PRIMARY` ON adresse');
        $this->addSql('ALTER TABLE adresse DROP pays, CHANGE libelle_voie libelle_voie VARCHAR(50) DEFAULT NULL, CHANGE code_postal code_postal VARCHAR(50) DEFAULT NULL, CHANGE ville ville VARCHAR(50) DEFAULT NULL, CHANGE type_adresse type_adresse VARCHAR(50) DEFAULT NULL, CHANGE id Id_adresse INT AUTO_INCREMENT NOT NULL');
        $this->addSql('ALTER TABLE adresse ADD PRIMARY KEY (Id_adresse)');
        $this->addSql('ALTER TABLE categorie MODIFY id INT NOT NULL');
        $this->addSql('DROP INDEX `PRIMARY` ON categorie');
        $this->addSql('ALTER TABLE categorie ADD Id_images INT NOT NULL, CHANGE nom_cat nom_cat VARCHAR(50) DEFAULT NULL, CHANGE description description VARCHAR(250) DEFAULT NULL, CHANGE id Id_categorie INT AUTO_INCREMENT NOT NULL');
        $this->addSql('ALTER TABLE categorie ADD CONSTRAINT fk_image_cat FOREIGN KEY (Id_images) REFERENCES images (Id_images)');
        $this->addSql('CREATE INDEX fk_image_cat ON categorie (Id_images)');
        $this->addSql('ALTER TABLE categorie ADD PRIMARY KEY (Id_categorie)');
        $this->addSql('ALTER TABLE client DROP FOREIGN KEY FK_C7440455BF396750');
        $this->addSql('DROP INDEX `PRIMARY` ON client');
        $this->addSql('ALTER TABLE client ADD methode_paiment VARCHAR(50) DEFAULT NULL, DROP methode_paiement, CHANGE nom_carte nom_carte VARCHAR(50) DEFAULT NULL, CHANGE numero_carte numero_carte VARCHAR(255) DEFAULT NULL, CHANGE date_expiration_carte date_expiration_carte VARCHAR(255) DEFAULT NULL, CHANGE cvv CVV VARCHAR(255) DEFAULT NULL, CHANGE id Id_utilisateur INT NOT NULL');
        $this->addSql('ALTER TABLE client ADD CONSTRAINT client_ibfk_1 FOREIGN KEY (Id_utilisateur) REFERENCES utilisateur (Id_utilisateur)');
        $this->addSql('ALTER TABLE client ADD PRIMARY KEY (Id_utilisateur)');
        $this->addSql('ALTER TABLE commandes MODIFY id INT NOT NULL');
        $this->addSql('ALTER TABLE commandes DROP FOREIGN KEY FK_35D4282C11C087F0');
        $this->addSql('DROP INDEX IDX_35D4282C11C087F0 ON commandes');
        $this->addSql('DROP INDEX `PRIMARY` ON commandes');
        $this->addSql('ALTER TABLE commandes CHANGE id Id_commandes INT AUTO_INCREMENT NOT NULL, CHANGE id_util_id Id_utilisateur INT NOT NULL');
        $this->addSql('ALTER TABLE commandes ADD CONSTRAINT commandes_ibfk_1 FOREIGN KEY (Id_utilisateur) REFERENCES utilisateur (Id_utilisateur)');
        $this->addSql('CREATE INDEX Id_utilisateur ON commandes (Id_utilisateur)');
        $this->addSql('ALTER TABLE commandes ADD PRIMARY KEY (Id_commandes)');
        $this->addSql('ALTER TABLE contact MODIFY id INT NOT NULL');
        $this->addSql('ALTER TABLE contact DROP FOREIGN KEY FK_4C62E63811C087F0');
        $this->addSql('DROP INDEX IDX_4C62E63811C087F0 ON contact');
        $this->addSql('DROP INDEX `PRIMARY` ON contact');
        $this->addSql('ALTER TABLE contact ADD texte VARCHAR(50) DEFAULT NULL, ADD email VARCHAR(150) DEFAULT NULL, DROP contenu, CHANGE sujet sujet VARCHAR(50) DEFAULT NULL, CHANGE date_contact date_contact DATE DEFAULT NULL, CHANGE id Id_contact INT AUTO_INCREMENT NOT NULL, CHANGE id_util_id Id_utilisateur INT NOT NULL');
        $this->addSql('ALTER TABLE contact ADD CONSTRAINT contact_ibfk_1 FOREIGN KEY (Id_utilisateur) REFERENCES utilisateur (Id_utilisateur)');
        $this->addSql('CREATE INDEX Id_utilisateur ON contact (Id_utilisateur)');
        $this->addSql('ALTER TABLE contact ADD PRIMARY KEY (Id_contact)');
        $this->addSql('ALTER TABLE detail_commande MODIFY id INT NOT NULL');
        $this->addSql('ALTER TABLE detail_commande DROP FOREIGN KEY FK_98344FA652BBBADA');
        $this->addSql('DROP INDEX IDX_98344FA652BBBADA ON detail_commande');
        $this->addSql('DROP INDEX `PRIMARY` ON detail_commande');
        $this->addSql('ALTER TABLE detail_commande ADD Id_commandes INT NOT NULL, DROP id_com_id, DROP quantite, CHANGE date_commande date_commande DATE DEFAULT NULL, CHANGE prix_tot prix_tot VARCHAR(50) DEFAULT NULL, CHANGE id Id_detail_commande INT AUTO_INCREMENT NOT NULL');
        $this->addSql('ALTER TABLE detail_commande ADD CONSTRAINT detail_commande_ibfk_1 FOREIGN KEY (Id_commandes) REFERENCES commandes (Id_commandes)');
        $this->addSql('CREATE INDEX Id_commandes ON detail_commande (Id_commandes)');
        $this->addSql('ALTER TABLE detail_commande ADD PRIMARY KEY (Id_detail_commande)');
        $this->addSql('ALTER TABLE images MODIFY id INT NOT NULL');
        $this->addSql('ALTER TABLE images DROP FOREIGN KEY FK_E01FBE6ADF559605');
        $this->addSql('DROP INDEX IDX_E01FBE6ADF559605 ON images');
        $this->addSql('DROP INDEX `PRIMARY` ON images');
        $this->addSql('ALTER TABLE images ADD Id_produit INT DEFAULT NULL, ADD code VARCHAR(4) DEFAULT NULL, DROP id_prod_id, CHANGE id Id_images INT AUTO_INCREMENT NOT NULL');
        $this->addSql('ALTER TABLE images ADD CONSTRAINT images_ibfk_1 FOREIGN KEY (Id_produit) REFERENCES produit (Id_produit)');
        $this->addSql('CREATE INDEX Id_produit ON images (Id_produit)');
        $this->addSql('ALTER TABLE images ADD PRIMARY KEY (Id_images)');
        $this->addSql('ALTER TABLE materiaux MODIFY id INT NOT NULL');
        $this->addSql('DROP INDEX `PRIMARY` ON materiaux');
        $this->addSql('ALTER TABLE materiaux ADD nom_mat VARCHAR(50) DEFAULT NULL, DROP nom__mat, CHANGE id Id_materiaux INT AUTO_INCREMENT NOT NULL');
        $this->addSql('ALTER TABLE materiaux ADD PRIMARY KEY (Id_materiaux)');
        $this->addSql('ALTER TABLE produit MODIFY id INT NOT NULL');
        $this->addSql('DROP INDEX `PRIMARY` ON produit');
        $this->addSql('ALTER TABLE produit ADD en_stock TINYINT(1) DEFAULT NULL, DROP stock, CHANGE nom_prod nom_prod VARCHAR(50) DEFAULT NULL, CHANGE description_prod description_prod VARCHAR(50) DEFAULT NULL, CHANGE prix_prod prix_prod DOUBLE PRECISION DEFAULT NULL, CHANGE disponibilite disponibilite TINYINT(1) DEFAULT NULL, CHANGE id Id_produit INT AUTO_INCREMENT NOT NULL');
        $this->addSql('ALTER TABLE produit ADD PRIMARY KEY (Id_produit)');
        $this->addSql('ALTER TABLE utilisateur MODIFY id INT NOT NULL');
        $this->addSql('DROP INDEX `PRIMARY` ON utilisateur');
        $this->addSql('ALTER TABLE utilisateur DROP telephone, DROP dtype, CHANGE nom nom VARCHAR(50) DEFAULT NULL, CHANGE prenom prenom VARCHAR(50) DEFAULT NULL, CHANGE email email VARCHAR(50) DEFAULT NULL, CHANGE mdp mdp VARCHAR(255) DEFAULT NULL, CHANGE id Id_utilisateur INT AUTO_INCREMENT NOT NULL');
        $this->addSql('ALTER TABLE utilisateur ADD PRIMARY KEY (Id_utilisateur)');
    }
}
