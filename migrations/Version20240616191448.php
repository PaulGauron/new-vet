<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240616191448 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE admin ADD PRIMARY KEY (id_utilisateur)');
        $this->addSql('ALTER TABLE admin ADD CONSTRAINT FK_880E0D7650EAE44 FOREIGN KEY (id_utilisateur) REFERENCES utilisateur (id_utilisateur) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE adresse MODIFY id INT NOT NULL');
        $this->addSql('DROP INDEX `primary` ON adresse');
        $this->addSql('ALTER TABLE adresse DROP id, CHANGE id_adresse id_adresse INT AUTO_INCREMENT NOT NULL');
        $this->addSql('ALTER TABLE adresse ADD PRIMARY KEY (id_adresse)');
        $this->addSql('ALTER TABLE categorie MODIFY id INT NOT NULL');
        $this->addSql('DROP INDEX `primary` ON categorie');
        $this->addSql('ALTER TABLE categorie DROP id, CHANGE id_categorie id_categorie INT AUTO_INCREMENT NOT NULL');
        $this->addSql('ALTER TABLE categorie ADD PRIMARY KEY (id_categorie)');
        $this->addSql('ALTER TABLE client DROP FOREIGN KEY FK_C7440455BF396750');
        $this->addSql('DROP INDEX `primary` ON client');
        $this->addSql('ALTER TABLE client CHANGE id id_utilisateur INT NOT NULL');
        $this->addSql('ALTER TABLE client ADD CONSTRAINT FK_C744045550EAE44 FOREIGN KEY (id_utilisateur) REFERENCES utilisateur (id_utilisateur) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE client ADD PRIMARY KEY (id_utilisateur)');
        $this->addSql('ALTER TABLE commandes MODIFY id INT NOT NULL');
        $this->addSql('DROP INDEX `primary` ON commandes');
        $this->addSql('ALTER TABLE commandes DROP id, CHANGE id_commandes id_commandes INT AUTO_INCREMENT NOT NULL');
        $this->addSql('ALTER TABLE commandes ADD PRIMARY KEY (id_commandes)');
        $this->addSql('ALTER TABLE concerner MODIFY id INT NOT NULL');
        $this->addSql('DROP INDEX `primary` ON concerner');
        $this->addSql('ALTER TABLE concerner DROP id, CHANGE id_produit id_produit INT AUTO_INCREMENT NOT NULL');
        $this->addSql('ALTER TABLE concerner ADD PRIMARY KEY (id_produit)');
        $this->addSql('ALTER TABLE contact MODIFY id INT NOT NULL');
        $this->addSql('DROP INDEX `primary` ON contact');
        $this->addSql('ALTER TABLE contact DROP id, CHANGE id_contact id_contact INT AUTO_INCREMENT NOT NULL');
        $this->addSql('ALTER TABLE contact ADD PRIMARY KEY (id_contact)');
        $this->addSql('ALTER TABLE correspond MODIFY id INT NOT NULL');
        $this->addSql('DROP INDEX `primary` ON correspond');
        $this->addSql('ALTER TABLE correspond DROP id, CHANGE id_commande id_commande INT AUTO_INCREMENT NOT NULL');
        $this->addSql('ALTER TABLE correspond ADD PRIMARY KEY (id_commande)');
        $this->addSql('ALTER TABLE detail_commande MODIFY id INT NOT NULL');
        $this->addSql('DROP INDEX `primary` ON detail_commande');
        $this->addSql('ALTER TABLE detail_commande DROP id, CHANGE id_detail_commande id_detail_commande INT AUTO_INCREMENT NOT NULL');
        $this->addSql('ALTER TABLE detail_commande ADD PRIMARY KEY (id_detail_commande)');
        $this->addSql('ALTER TABLE enregistre MODIFY id INT NOT NULL');
        $this->addSql('DROP INDEX `primary` ON enregistre');
        $this->addSql('ALTER TABLE enregistre DROP id, CHANGE id_utilisateur id_utilisateur INT AUTO_INCREMENT NOT NULL');
        $this->addSql('ALTER TABLE enregistre ADD PRIMARY KEY (id_utilisateur)');
        $this->addSql('ALTER TABLE image MODIFY id INT NOT NULL');
        $this->addSql('DROP INDEX `primary` ON image');
        $this->addSql('ALTER TABLE image DROP id, CHANGE id_images id_images INT AUTO_INCREMENT NOT NULL');
        $this->addSql('ALTER TABLE image ADD PRIMARY KEY (id_images)');
        $this->addSql('ALTER TABLE lier MODIFY id INT NOT NULL');
        $this->addSql('DROP INDEX `primary` ON lier');
        $this->addSql('ALTER TABLE lier DROP id, CHANGE id_categorie id_categorie INT AUTO_INCREMENT NOT NULL');
        $this->addSql('ALTER TABLE lier ADD PRIMARY KEY (id_categorie)');
        $this->addSql('ALTER TABLE materiaux MODIFY id INT NOT NULL');
        $this->addSql('DROP INDEX `primary` ON materiaux');
        $this->addSql('ALTER TABLE materiaux DROP id, CHANGE id_materiaux id_materiaux INT AUTO_INCREMENT NOT NULL');
        $this->addSql('ALTER TABLE materiaux ADD PRIMARY KEY (id_materiaux)');
        $this->addSql('ALTER TABLE produit MODIFY id INT NOT NULL');
        $this->addSql('DROP INDEX `primary` ON produit');
        $this->addSql('ALTER TABLE produit DROP id, CHANGE id_produit id_produit INT AUTO_INCREMENT NOT NULL');
        $this->addSql('ALTER TABLE produit ADD PRIMARY KEY (id_produit)');
        $this->addSql('ALTER TABLE utilisateur MODIFY id INT NOT NULL');
        $this->addSql('DROP INDEX `primary` ON utilisateur');
        $this->addSql('ALTER TABLE utilisateur DROP id, CHANGE id_utilisateur id_utilisateur INT AUTO_INCREMENT NOT NULL');
        $this->addSql('ALTER TABLE utilisateur ADD PRIMARY KEY (id_utilisateur)');
        $this->addSql('ALTER TABLE utiliser MODIFY id INT NOT NULL');
        $this->addSql('DROP INDEX `primary` ON utiliser');
        $this->addSql('ALTER TABLE utiliser DROP id, CHANGE id_produit id_produit INT AUTO_INCREMENT NOT NULL');
        $this->addSql('ALTER TABLE utiliser ADD PRIMARY KEY (id_produit)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE admin DROP FOREIGN KEY FK_880E0D7650EAE44');
        $this->addSql('DROP INDEX `primary` ON admin');
        $this->addSql('ALTER TABLE adresse ADD id INT AUTO_INCREMENT NOT NULL, CHANGE id_adresse id_adresse INT NOT NULL, DROP PRIMARY KEY, ADD PRIMARY KEY (id)');
        $this->addSql('ALTER TABLE categorie ADD id INT AUTO_INCREMENT NOT NULL, CHANGE id_categorie id_categorie INT NOT NULL, DROP PRIMARY KEY, ADD PRIMARY KEY (id)');
        $this->addSql('ALTER TABLE client DROP FOREIGN KEY FK_C744045550EAE44');
        $this->addSql('DROP INDEX `PRIMARY` ON client');
        $this->addSql('ALTER TABLE client CHANGE id_utilisateur id INT NOT NULL');
        $this->addSql('ALTER TABLE client ADD CONSTRAINT FK_C7440455BF396750 FOREIGN KEY (id) REFERENCES utilisateur (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE client ADD PRIMARY KEY (id)');
        $this->addSql('ALTER TABLE commandes ADD id INT AUTO_INCREMENT NOT NULL, CHANGE id_commandes id_commandes INT NOT NULL, DROP PRIMARY KEY, ADD PRIMARY KEY (id)');
        $this->addSql('ALTER TABLE concerner ADD id INT AUTO_INCREMENT NOT NULL, CHANGE id_produit id_produit INT NOT NULL, DROP PRIMARY KEY, ADD PRIMARY KEY (id)');
        $this->addSql('ALTER TABLE contact ADD id INT AUTO_INCREMENT NOT NULL, CHANGE id_contact id_contact INT NOT NULL, DROP PRIMARY KEY, ADD PRIMARY KEY (id)');
        $this->addSql('ALTER TABLE correspond ADD id INT AUTO_INCREMENT NOT NULL, CHANGE id_commande id_commande INT NOT NULL, DROP PRIMARY KEY, ADD PRIMARY KEY (id)');
        $this->addSql('ALTER TABLE detail_commande ADD id INT AUTO_INCREMENT NOT NULL, CHANGE id_detail_commande id_detail_commande INT NOT NULL, DROP PRIMARY KEY, ADD PRIMARY KEY (id)');
        $this->addSql('ALTER TABLE enregistre ADD id INT AUTO_INCREMENT NOT NULL, CHANGE id_utilisateur id_utilisateur INT NOT NULL, DROP PRIMARY KEY, ADD PRIMARY KEY (id)');
        $this->addSql('ALTER TABLE image ADD id INT AUTO_INCREMENT NOT NULL, CHANGE id_images id_images INT NOT NULL, DROP PRIMARY KEY, ADD PRIMARY KEY (id)');
        $this->addSql('ALTER TABLE lier ADD id INT AUTO_INCREMENT NOT NULL, CHANGE id_categorie id_categorie INT NOT NULL, DROP PRIMARY KEY, ADD PRIMARY KEY (id)');
        $this->addSql('ALTER TABLE materiaux ADD id INT AUTO_INCREMENT NOT NULL, CHANGE id_materiaux id_materiaux INT NOT NULL, DROP PRIMARY KEY, ADD PRIMARY KEY (id)');
        $this->addSql('ALTER TABLE produit ADD id INT AUTO_INCREMENT NOT NULL, CHANGE id_produit id_produit INT NOT NULL, DROP PRIMARY KEY, ADD PRIMARY KEY (id)');
        $this->addSql('ALTER TABLE utilisateur ADD id INT AUTO_INCREMENT NOT NULL, CHANGE id_utilisateur id_utilisateur INT NOT NULL, DROP PRIMARY KEY, ADD PRIMARY KEY (id)');
        $this->addSql('ALTER TABLE utiliser ADD id INT AUTO_INCREMENT NOT NULL, CHANGE id_produit id_produit INT NOT NULL, DROP PRIMARY KEY, ADD PRIMARY KEY (id)');
    }
}
