<?php

namespace App\Entity;

use App\Repository\ConcernerRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ConcernerRepository::class)]
class Concerner
{
    #[ORM\Id]
    #[ORM\ManyToOne(targetEntity:"App\Entity\Produit",inversedBy:"concernes")]
    #[ORM\JoinColumn(nullable:false)]
    private ?int $id_produit = null;

    #[ORM\Id]
    #[ORM\ManyToOne(targetEntity:"App\Entity\Commandes",inversedBy:"concernes")]
    #[ORM\JoinColumn(nullable:false)]
    private ?int $id_commandes = null;

    #[ORM\Column]
    private ?float $prix_calcul = null;

    #[ORM\Column]
    private ?int $quantite = null;

    public function getIdProduit(): ?int
    {
        return $this->id_produit;
    }

   
    public function getIdCommandes(): ?int
    {
        return $this->id_commandes;
    }


    public function getPrixCalcul(): ?float
    {
        return $this->prix_calcul;
    }

    public function setPrixCalcul(float $prix_calcul): static
    {
        $this->prix_calcul = $prix_calcul;

        return $this;
    }

    public function getQuantite(): ?int
    {
        return $this->quantite;
    }

    public function setQuantite(int $quantite): static
    {
        $this->quantite = $quantite;

        return $this;
    }
}
