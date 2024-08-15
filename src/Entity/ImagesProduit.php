<?php

namespace App\Entity;

use App\Repository\ImagesProduitRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ImagesProduitRepository::class)]
class ImagesProduit
{
    #[ORM\Id]
    #[ORM\ManyToOne(targetEntity:Produit::class, inversedBy: 'imagesProduits')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Produit $produit = null;

    #[ORM\Id]
    #[ORM\ManyToOne(targetEntity:Images::class, inversedBy: 'imagesProduits')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Images $image = null;

    public function getProduit(): ?Produit
    {
        return $this->produit;
    }

    public function setProduit(?Produit $produit): static
    {
        $this->produit = $produit;

        return $this;
    }

    public function getImage(): ?Images
    {
        return $this->image;
    }

    public function setImage(?Images $image): static
    {
        $this->image = $image;

        return $this;
    }
}
