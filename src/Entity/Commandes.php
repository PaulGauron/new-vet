<?php

namespace App\Entity;

use App\Repository\CommandesRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CommandesRepository::class)]
class Commandes
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'commandes')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Utilisateur $id_util = null;

    /**
     * @var Collection<int, DetailCommande>
     */
    #[ORM\OneToMany(targetEntity: DetailCommande::class, mappedBy: 'id_com', orphanRemoval: true)]
    private Collection $id_com;

    /**
     * @var Collection<int, Produit>
     */
    #[ORM\OneToMany(targetEntity: Produit::class, mappedBy: 'prduitCommande', orphanRemoval: true)]
    private Collection $produitCommande;

    /**
     * @var Collection<int, AdresseCommandes>
     */
    #[ORM\OneToMany(targetEntity: AdresseCommandes::class, mappedBy: 'id_commandes', orphanRemoval: true)]
    private Collection $id_commande;

    public function __construct()
    {
        $this->id_com = new ArrayCollection();
        $this->id_commande = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIdUtil(): ?Utilisateur
    {
        return $this->id_util;
    }

    public function setIdUtil(?Utilisateur $id_util): static
    {
        $this->id_util = $id_util;

        return $this;
    }

    /**
     * @return Collection<int, DetailCommande>
     */
    public function getIdCom(): Collection
    {
        return $this->id_com;
    }

    public function addIdCom(DetailCommande $idCom): static
    {
        if (!$this->id_com->contains($idCom)) {
            $this->id_com->add($idCom);
            $idCom->setIdCom($this);
        }

        return $this;
    }

    public function removeIdCom(DetailCommande $idCom): static
    {
        if ($this->id_com->removeElement($idCom)) {
            // set the owning side to null (unless already changed)
            if ($idCom->getIdCom() === $this) {
                $idCom->setIdCom(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, ProduitCommandes>
     */
    public function getIdProduitCommande(): Collection
    {
        return $this->produitCommande;
    }

    public function addIdProduitCommande(ProduitCommandes $ProduitCommandes): static
    {
        if (!$this->produitCommande->contains($ProduitCommandes)) {
            $this->produitCommande->add($ProduitCommandes);
            $ProduitCommandes->setIdCommande($this);
        }

        return $this;
    }

    public function removeProduitCommandes(ProduitCommandes $ProduitCommandes): static
    {
        if ($this->produitCommande->removeElement($ProduitCommandes)) {
            // set the owning side to null (unless already changed)
            if ($ProduitCommandes->getIdCommande() === $this) {
                $ProduitCommandes->setIdCommande(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, AdresseCommandes>
     */
    public function getIdCommande(): Collection
    {
        return $this->id_commande;
    }

    public function addIdCommande(AdresseCommandes $idCommande): static
    {
        if (!$this->id_commande->contains($idCommande)) {
            $this->id_commande->add($idCommande);
            $idCommande->setIdCommandes($this);
        }

        return $this;
    }

    public function removeIdCommande(AdresseCommandes $idCommande): static
    {
        if ($this->id_commande->removeElement($idCommande)) {
            // set the owning side to null (unless already changed)
            if ($idCommande->getIdCommandes() === $this) {
                $idCommande->setIdCommandes(null);
            }
        }

        return $this;
    }
}
