<?php

namespace App\Entity;

use App\Repository\ConcernerRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ConcernerRepository::class)]
class Concerner
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id_produit = null;

    #[ORM\Column]
    private ?int $id_commandes = null;

    #[ORM\Column]
    private ?float $prix_calcul = null;

    #[ORM\Column]
    private ?int $quantite = null;

    public function getIdProduit(): ?int
    {
        return $this->id_produit;
    }

    public function setIdProduit(int $id_produit): static
    {
        $this->id_produit = $id_produit;

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

    public function getPrixCalcul(): ?float
    {
        return $this->prix_calcul;
    }

    public function setPrixCalcul(float $prix_calcul): static
    {
        $this->prix_calcul = $prix_calcul;

        return $this;
    }

    public function getQuantite(): ?int
    {
        return $this->quantite;
    }

    public function setQuantite(int $quantite): static
    {
        $this->quantite = $quantite;

        return $this;
    }
}
