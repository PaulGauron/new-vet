<?php

namespace App\Entity;

use App\Repository\ImagesRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ImagesRepository::class)]
class Images
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $nom_image = null;

    /**
     * @var Collection<int, ImagesProduit>
     */
    #[ORM\OneToMany(targetEntity: ImagesProduit::class, mappedBy: 'image')]
    private Collection $imagesProduits;

    public function __construct()
    {
        $this->imagesProduits = new ArrayCollection();
    }

   

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomImage(): ?string
    {
        return $this->nom_image;
    }

    public function setNomImage(string $nom_image): static
    {
        $this->nom_image = $nom_image;

        return $this;
    }

    /**
     * @return Collection<int, ImagesProduit>
     */
    public function getImagesProduits(): Collection
    {
        return $this->imagesProduits;
    }

    public function addImagesProduit(ImagesProduit $imagesProduit): static
    {
        if (!$this->imagesProduits->contains($imagesProduit)) {
            $this->imagesProduits->add($imagesProduit);
            $imagesProduit->setImage($this);
        }

        return $this;
    }

    public function removeImagesProduit(ImagesProduit $imagesProduit): static
    {
        if ($this->imagesProduits->removeElement($imagesProduit)) {
            // set the owning side to null (unless already changed)
            if ($imagesProduit->getImage() === $this) {
                $imagesProduit->setImage(null);
            }
        }

        return $this;
    }

}
