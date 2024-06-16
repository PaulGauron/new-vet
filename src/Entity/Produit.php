<?php

namespace App\Entity;

use App\Repository\ProduitRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ProduitRepository::class)]
class Produit
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id_produit = null;

    #[ORM\Column(length: 255)]
    private ?string $nom_prod = null;

    #[ORM\Column(length: 255)]
    private ?string $description_prod = null;

    #[ORM\Column]
    private ?float $prix_prod = null;

    #[ORM\Column]
    private ?int $en_stock = null;

    #[ORM\Column(type: Types::SMALLINT)]
    private ?int $disponibilite = null;

    public function getId(): ?int
    {
        return $this->id_produit;
    }

    public function getIdProduit(): ?int
    {
        return $this->id_produit;
    }

    public function setIdProduit(int $id_produit): static
    {
        $this->id_produit = $id_produit;

        return $this;
    }

    public function getNomProd(): ?string
    {
        return $this->nom_prod;
    }

    public function setNomProd(string $nom_prod): static
    {
        $this->nom_prod = $nom_prod;

        return $this;
    }

    public function getDescriptionProd(): ?string
    {
        return $this->description_prod;
    }

    public function setDescriptionProd(string $description_prod): static
    {
        $this->description_prod = $description_prod;

        return $this;
    }

    public function getPrixProd(): ?float
    {
        return $this->prix_prod;
    }

    public function setPrixProd(float $prix_prod): static
    {
        $this->prix_prod = $prix_prod;

        return $this;
    }

    public function getEnStock(): ?int
    {
        return $this->en_stock;
    }

    public function setEnStock(int $en_stock): static
    {
        $this->en_stock = $en_stock;

        return $this;
    }

    public function getDisponibilite(): ?int
    {
        return $this->disponibilite;
    }

    public function setDisponibilite(int $disponibilite): static
    {
        $this->disponibilite = $disponibilite;

        return $this;
    }
}
