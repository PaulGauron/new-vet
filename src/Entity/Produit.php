<?php

namespace App\Entity;

use App\Repository\ProduitRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: ProduitRepository::class)]
class Produit
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Assert\Type(
        type: 'integer',
        message: 'La valeur {{ value }} n\'est pas valide',
    )]
    private ?int $id = null;

    #[ORM\Column(length: 50)]
    #[Assert\NotBlank]
    #[Assert\Type(
        type: 'string',
        message: 'La valeur {{ value }} n\'est pas valide',
    )]
    private ?string $nom_prod = null;
    
    #[ORM\Column(length: 255)]
    #[Assert\Type(
        type: 'string',
        message: 'La valeur {{ value }} n\'est pas valide',
    )]
    private ?string $description_prod = null;

    #[ORM\Column]
    #[Assert\NotBlank]
    #[Assert\Type(
        type: 'float',
        message: 'La valeur {{ value }} n\'est pas valide',
    )]
    private ?float $prix_prod = null;

    #[ORM\Column]
    private ?int $stock = null;

    #[ORM\Column]
    private ?bool $disponibilite = null;


    /**
     * @var Collection<int, ProduitCommandes>
     */
    #[ORM\OneToMany(targetEntity: ProduitCommandes::class, mappedBy: 'commande', orphanRemoval: true)]
    private Collection $produitCommande;

    #[ORM\OneToMany(targetEntity: ProduitMateriaux::class, mappedBy: 'id_produit', orphanRemoval: true)]
    private Collection $produit_materiaux;

    #[ORM\ManyToOne(inversedBy: 'produit_categorie')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Categorie $categorie = null;

    #[ORM\Column]
    private ?bool $highlander = null;

    #[ORM\Column]
    private ?int $ordre = null;

    /**
     * @var Collection<int, ImagesProduit>
     */
    #[ORM\OneToMany(targetEntity: ImagesProduit::class, mappedBy: 'produit', orphanRemoval: true)]
    private Collection $imagesProduits;

    public function __construct()
    {
        $this->produitCommande = new ArrayCollection();
        $this->imagesProduits = new ArrayCollection();
        $this->produit_materiaux = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }
    //
    public function getNomMat(): string
    {
    $nomsMat = [];
    foreach ($this->produit_materiaux as $produitMateriaux) {
        $materiaux = $produitMateriaux->getIdMateriaux();
        if ($materiaux) {
            $nomsMat[] = $materiaux->getNomMat();
        }
    }
    return implode(', ', $nomsMat);
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

    public function getStock(): ?int
    {
        return $this->stock;
    }

    public function setStock(int $stock): static
    {
        $this->stock = $stock;

        return $this;
    }

    public function getDisponibilite(): ?bool
    {
        return $this->disponibilite;
    }

    public function setDisponibilite(bool $disponibilite): static
    {
        $this->disponibilite = $disponibilite;

        return $this;
    }
   

/**
     * @return Collection<int, ProduitCommandes>
     */
    public function getProduitMateriaux(): Collection
    {
        return $this->produit_materiaux;
    }

    public function addProduitMateriaux(ProduitMateriaux $produitMateriaux): static
    {
        if (!$this->produit_materiaux->contains($produitMateriaux)) {
            $this->produit_materiaux->add($produitMateriaux);
            $produitMateriaux->setIdProduit($this);
        }

        return $this;
    }

    public function removeProduitMateriaux(ProduitMateriaux $produitMateriaux): static
    {
        if ($this->produit_materiaux->removeElement($produitMateriaux)) {
            // set the owning side to null (unless already changed)
            if ($produitMateriaux->getIdProduit() === $this) {
                $produitMateriaux->setIdProduit(null);
            }
        }

        return $this;
    }


    /**
     * @return Collection<int, ProduitCommandes>
     */
    public function getProduitCommande(): Collection
    {
        return $this->produitCommande;
    }

    public function addProduitCommande(ProduitCommandes $produitCommande): static
    {
        if (!$this->produitCommande->contains($produitCommande)) {
            $this->produitCommande->add($produitCommande);
            $produitCommande->setIdProduit($this);
        }

        return $this;
    }

    public function removeProduitCommande(ProduitCommandes $produitCommande): static
    {
        if ($this->produitCommande->removeElement($produitCommande)) {
            // set the owning side to null (unless already changed)
            if ($produitCommande->getIdProduit() === $this) {
                $produitCommande->setIdProduit(null);
            }
        }

        return $this;
    }

    public function getCategorie(): ?Categorie
    {
        return $this->categorie;
    }

    public function setCategorie(?Categorie $categorie): static
    {
        $this->categorie = $categorie;

        return $this;
    }

    public function getHighlander(): ?bool
    {
        return $this->highlander;
    }

    public function setHighlander(bool $highlander): static
    {
        $this->highlander = $highlander;

        return $this;
    }

    public function getOrdre(): ?int
    {
        return $this->ordre;
    }

    public function setOrdre(int $ordre): static
    {
        $this->ordre = $ordre;

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
            $imagesProduit->setProduit($this);
        }

        return $this;
    }

    public function removeImagesProduit(ImagesProduit $imagesProduit): static
    {
        if ($this->imagesProduits->removeElement($imagesProduit)) {
            // set the owning side to null (unless already changed)
            if ($imagesProduit->getProduit() === $this) {
                $imagesProduit->setProduit(null);
            }
        }

        return $this;
    }
}
