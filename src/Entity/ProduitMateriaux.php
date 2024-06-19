<?php

namespace App\Entity;

use App\Repository\ProduitMateriauxRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ProduitMateriauxRepository::class)]
class ProduitMateriaux
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'materiaux_produit')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Materiaux $id_materiaux = null;

    #[ORM\ManyToOne(inversedBy: 'Produit_Materiaux')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Produit $id_produit = null;

    public function getId(): ?int
    {
        return $this->id;
    }

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
