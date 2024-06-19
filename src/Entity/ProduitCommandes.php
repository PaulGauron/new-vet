<?php

namespace App\Entity;

use App\Repository\ProduitCommandesRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ProduitCommandesRepository::class)]
class ProduitCommandes
{
    #[ORM\Id]
    #[ORM\ManyToOne(targetEntity:Commandes::class, inversedBy:'produit_commande')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Commandes $id_commande = null;

    #[ORM\Id]
    #[ORM\ManyToOne(targetEntity:Produit::class, inversedBy:'produit_commande')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Produit $id_produit = null;

    #[ORM\Column]
    private ?float $prix_calcul = null;

    #[ORM\Column]
    private ?int $quantite = null;

    public function getIdCommande(): ?int
    {
        return $this->id_commande;
    }

    public function setIdCommande(?Commandes $id_commande): static
    {
        $this->id_commande = $id_commande;
        return $this;
    }

    public function getIdProduit(): ?Produit
    {
        return $this->id_produit;
    }

    public function setIdProduit(?Produit $id_produit): static
    {
        $this->id_produit = $id_produit;

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
