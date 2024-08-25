<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240825215125 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE produit_commandes DROP FOREIGN KEY FK_B14376C09AF8E3A3');
        $this->addSql('DROP INDEX IDX_B14376C09AF8E3A3 ON produit_commandes');
        $this->addSql('DROP INDEX `primary` ON produit_commandes');
        $this->addSql('ALTER TABLE produit_commandes CHANGE id_commande_id commande_id INT NOT NULL');
        $this->addSql('ALTER TABLE produit_commandes ADD CONSTRAINT FK_B14376C082EA2E54 FOREIGN KEY (commande_id) REFERENCES commandes (id)');
        $this->addSql('CREATE INDEX IDX_B14376C082EA2E54 ON produit_commandes (commande_id)');
        $this->addSql('ALTER TABLE produit_commandes ADD PRIMARY KEY (commande_id, id_produit_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE produit_commandes DROP FOREIGN KEY FK_B14376C082EA2E54');
        $this->addSql('DROP INDEX IDX_B14376C082EA2E54 ON produit_commandes');
        $this->addSql('DROP INDEX `PRIMARY` ON produit_commandes');
        $this->addSql('ALTER TABLE produit_commandes CHANGE commande_id id_commande_id INT NOT NULL');
        $this->addSql('ALTER TABLE produit_commandes ADD CONSTRAINT FK_B14376C09AF8E3A3 FOREIGN KEY (id_commande_id) REFERENCES commandes (id)');
        $this->addSql('CREATE INDEX IDX_B14376C09AF8E3A3 ON produit_commandes (id_commande_id)');
        $this->addSql('ALTER TABLE produit_commandes ADD PRIMARY KEY (id_commande_id, id_produit_id)');
    }
}
