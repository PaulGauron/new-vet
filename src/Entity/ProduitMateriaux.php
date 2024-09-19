<?php

namespace App\Entity;

use App\Repository\ProduitMateriauxRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ProduitMateriauxRepository::class)]
class ProduitMateriaux
{
    #[ORM\Id]
    #[ORM\ManyToOne(targetEntity:Materiaux::class, inversedBy: 'materiaux_produit')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Materiaux $id_materiaux = null;

    #[ORM\Id]
    #[ORM\ManyToOne(targetEntity:Produit::class, inversedBy: 'Produit_Materiaux', cascade: ["persist"]  )]
    #[ORM\JoinColumn(nullable: false)]
    private ?Produit $id_produit = null;

    public function getIdMateriaux(): ?Materiaux
    {
        return $this->id_materiaux;
    }

    public function setIdMateriaux(?Materiaux $id_materiaux): static
    {
        $this->id_materiaux = $id_materiaux;

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
}
