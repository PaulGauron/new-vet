<?php

namespace App\Entity;

use App\Repository\ImagesRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ImagesRepository::class)]
class Images
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'images')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Produit $id_prod = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIdProd(): ?Produit
    {
        return $this->id_prod;
    }

    public function setIdProd(?Produit $id_prod): static
    {
        $this->id_prod = $id_prod;

        return $this;
    }
}
