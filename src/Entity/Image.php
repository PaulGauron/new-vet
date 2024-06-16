<?php

namespace App\Entity;

use App\Repository\ImageRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ImageRepository::class)]
class Image
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id_images = null;

    #[ORM\Column(nullable: true)]
    private ?int $id_produit = null;

    #[ORM\Column(length: 6)]
    private ?string $code = null;

    public function getId(): ?int
    {
        return $this->id_images;
    }

    public function getIdImages(): ?int
    {
        return $this->id_images;
    }

    public function setIdImages(int $id_images): static
    {
        $this->id_images = $id_images;

        return $this;
    }

    public function getIdProduit(): ?int
    {
        return $this->id_produit;
    }

    public function setIdProduit(?int $id_produit): static
    {
        $this->id_produit = $id_produit;

        return $this;
    }

    public function getCode(): ?string
    {
        return $this->code;
    }

    public function setCode(string $code): static
    {
        $this->code = $code;

        return $this;
    }
}
