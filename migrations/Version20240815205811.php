<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240815205811 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE images_produit (produit_id INT NOT NULL, image_id INT NOT NULL, INDEX IDX_B6D8F245F347EFB (produit_id), INDEX IDX_B6D8F2453DA5256D (image_id), PRIMARY KEY(produit_id, image_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE images_produit ADD CONSTRAINT FK_B6D8F245F347EFB FOREIGN KEY (produit_id) REFERENCES produit (id)');
        $this->addSql('ALTER TABLE images_produit ADD CONSTRAINT FK_B6D8F2453DA5256D FOREIGN KEY (image_id) REFERENCES images (id)');
        $this->addSql('ALTER TABLE images DROP FOREIGN KEY FK_E01FBE6ADF559605');
        $this->addSql('DROP INDEX IDX_E01FBE6ADF559605 ON images');
        $this->addSql('ALTER TABLE images ADD nom_image VARCHAR(255) NOT NULL, DROP id_prod_id');
        $this->addSql('ALTER TABLE produit ADD is_highlander TINYINT(1) NOT NULL, ADD ordre INT NOT NULL');
        $this->addSql('ALTER TABLE produit_materiaux MODIFY id INT NOT NULL');
        $this->addSql('DROP INDEX `primary` ON produit_materiaux');
        $this->addSql('ALTER TABLE produit_materiaux DROP id');
        $this->addSql('ALTER TABLE produit_materiaux ADD PRIMARY KEY (id_materiaux_id, id_produit_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE images_produit DROP FOREIGN KEY FK_B6D8F245F347EFB');
        $this->addSql('ALTER TABLE images_produit DROP FOREIGN KEY FK_B6D8F2453DA5256D');
        $this->addSql('DROP TABLE images_produit');
        $this->addSql('ALTER TABLE images ADD id_prod_id INT NOT NULL, DROP nom_image');
        $this->addSql('ALTER TABLE images ADD CONSTRAINT FK_E01FBE6ADF559605 FOREIGN KEY (id_prod_id) REFERENCES produit (id)');
        $this->addSql('CREATE INDEX IDX_E01FBE6ADF559605 ON images (id_prod_id)');
        $this->addSql('ALTER TABLE produit DROP is_highlander, DROP ordre');
        $this->addSql('ALTER TABLE produit_materiaux ADD id INT AUTO_INCREMENT NOT NULL, DROP PRIMARY KEY, ADD PRIMARY KEY (id)');
    }
}
