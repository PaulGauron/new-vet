<?php

namespace App\Entity;

use App\Repository\ProduitCommandesRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ProduitCommandesRepository::class)]
class ProduitCommandes
{
    #[ORM\Id]
    #[ORM\ManyToOne(targetEntity:Commandes::class, inversedBy:'produitCommande')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Commandes $commande = null;

    #[ORM\Id]
    #[ORM\ManyToOne(targetEntity:Produit::class, inversedBy:'produitCommande')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Produit $id_produit = null;


    #[ORM\Column]
    private ?int $quantite = null;

    public function getIdCommande(): ?int
    {
        return $this->commande;
    }

    public function setIdCommande(?Commandes $id_commande): static
    {
        $this->commande = $id_commande;
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
