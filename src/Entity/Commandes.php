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
     * @var Collection<int, ProduitCommandes>
     */
    #[ORM\OneToMany(targetEntity: ProduitCommandes::class, mappedBy: 'commande', orphanRemoval: true)]
    private Collection $produitCommande;

    #[ORM\ManyToOne(inversedBy: 'commandes_adresse')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Adresse $adresse = null;

    
    public function __construct()
    {
        $this->id_com = new ArrayCollection();
        $this->produitCommande = new ArrayCollection();
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
            $ProduitCommandes->setCommande($this);
        }

        return $this;
    }

    public function removeProduitCommandes(ProduitCommandes $ProduitCommandes): static
    {
        if ($this->produitCommande->removeElement($ProduitCommandes)) {
            // set the owning side to null (unless already changed)
            if ($ProduitCommandes->getCommande() === $this) {
                $ProduitCommandes->setCommande(null);
            }
        }

        return $this;
    }

    public function getIdAdresse(): ?Adresse
    {
        return $this->adresse;
    }

    public function setIdAdresse(?Adresse $id_adresse): static
    {
        $this->adresse = $id_adresse;

        return $this;
    }


}
