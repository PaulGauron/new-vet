<?php

namespace App\Entity;

use App\Repository\CategorieRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CategorieRepository::class)]
class Categorie
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 50)]
    private ?string $nom_cat = null;

    #[ORM\Column(length: 255)]
    private ?string $description = null;

    /**
     * @var Collection<int, Produit>
     */
    #[ORM\OneToMany(targetEntity: Produit::class, mappedBy: 'id_categorie')]
    private Collection $produit;

    public function __construct()
    {
        $this->produit = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomCat(): ?string
    {
        return $this->nom_cat;
    }

    public function setNomCat(string $nom_cat): static
    {
        $this->nom_cat = $nom_cat;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): static
    {
        $this->description = $description;

        return $this;
    }

    /**
     * @return Collection<int, Produit>
     */
    public function getProduitCategorie(): Collection
    {
        return $this->produit;
    }

    public function addProduitCategorie(Produit $produitCategorie): static
    {
        if (!$this->produit->contains($produitCategorie)) {
            $this->produit->add($produitCategorie);
            $produitCategorie->setIdCategorie($this);
        }

        return $this;
    }

    public function removeProduitCategorie(Produit $produitCategorie): static
    {
        if ($this->produit->removeElement($produitCategorie)) {
            // set the owning side to null (unless already changed)
            if ($produitCategorie->getIdCategorie() === $this) {
                $produitCategorie->setIdCategorie(null);
            }
        }

        return $this;
    }
}
