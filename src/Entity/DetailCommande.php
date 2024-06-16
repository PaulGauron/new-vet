<?php

namespace App\Entity;

use App\Repository\DetailCommandeRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: DetailCommandeRepository::class)]
class DetailCommande
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id_detail_commande = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $date_commande = null;

    #[ORM\Column]
    private ?int $prix_tot = null;

    #[ORM\Column]
    private ?int $id_commandes = null;

    public function getId(): ?int
    {
        return $this->id_detail_commande;
    }

    public function getIdDetailCommande(): ?int
    {
        return $this->id_detail_commande;
    }

    public function setIdDetailCommande(int $id_detail_commande): static
    {
        $this->id_detail_commande = $id_detail_commande;

        return $this;
    }

    public function getDateCommande(): ?\DateTimeInterface
    {
        return $this->date_commande;
    }

    public function setDateCommande(\DateTimeInterface $date_commande): static
    {
        $this->date_commande = $date_commande;

        return $this;
    }

    public function getPrixTot(): ?int
    {
        return $this->prix_tot;
    }

    public function setPrixTot(int $prix_tot): static
    {
        $this->prix_tot = $prix_tot;

        return $this;
    }

    public function getIdCommandes(): ?int
    {
        return $this->id_commandes;
    }

    public function setIdCommandes(int $id_commandes): static
    {
        $this->id_commandes = $id_commandes;

        return $this;
    }
}
