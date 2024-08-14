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
        type: 'integer',
        message: 'La valeur {{ value }} n\'est pas valide',
    )]
    private ?float $prix_prod = null;

    #[ORM\Column]
    private ?int $stock = null;

    #[ORM\Column(type: Types::SMALLINT)]
    private ?int $disponibilite = null;

    /**
     * @var Collection<int, Images>
     */
    #[ORM\OneToMany(targetEntity: Images::class, mappedBy: 'id_prod', orphanRemoval: true)]
    private Collection $images;

    /**
     * @var Collection<int, ProduitCommandes>
     */
    #[ORM\OneToMany(targetEntity: ProduitCommandes::class, mappedBy: 'id_produit', orphanRemoval: true)]
    private Collection $produit_commande;

    #[ORM\ManyToOne(inversedBy: 'produit_categorie')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Categorie $categorie = null;

    public function __construct()
    {
        $this->images = new ArrayCollection();
        $this->produit_commande = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
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

    public function getDisponibilite(): ?int
    {
        return $this->disponibilite;
    }

    public function setDisponibilite(int $disponibilite): static
    {
        $this->disponibilite = $disponibilite;

        return $this;
    }

    /**
     * @return Collection<int, Images>
     */
    public function getImages(): Collection
    {
        return $this->images;
    }

    public function addImage(Images $image): static
    {
        if (!$this->images->contains($image)) {
            $this->images->add($image);
            $image->setIdProd($this);
        }

        return $this;
    }

    public function removeImage(Images $image): static
    {
        if ($this->images->removeElement($image)) {
            // set the owning side to null (unless already changed)
            if ($image->getIdProd() === $this) {
                $image->setIdProd(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, ProduitCommandes>
     */
    public function getProduitCommande(): Collection
    {
        return $this->produit_commande;
    }

    public function addProduitCommande(ProduitCommandes $produitCommande): static
    {
        if (!$this->produit_commande->contains($produitCommande)) {
            $this->produit_commande->add($produitCommande);
            $produitCommande->setIdProduit($this);
        }

        return $this;
    }

    public function removeProduitCommande(ProduitCommandes $produitCommande): static
    {
        if ($this->produit_commande->removeElement($produitCommande)) {
            // set the owning side to null (unless already changed)
            if ($produitCommande->getIdProduit() === $this) {
                $produitCommande->setIdProduit(null);
            }
        }

        return $this;
    }

    public function getIdCategorie(): ?Categorie
    {
        return $this->categorie;
    }

    public function setIdCategorie(?Categorie $id_categorie): static
    {
        $this->categorie = $id_categorie;

        return $this;
    }
}
