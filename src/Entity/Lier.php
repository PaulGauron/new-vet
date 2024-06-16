<?php

namespace App\Entity;

use App\Repository\LierRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: LierRepository::class)]
class Lier
{
      
    #[ORM\Id]
    #[ORM\ManyToOne(targetEntity:"App\Entity\Categorie",inversedBy:"categorie")]
    #[ORM\JoinColumn(nullable:false)]
    private ?int $id_categorie = null;

    #[ORM\Id]
    #[ORM\ManyToOne(targetEntity:"App\Entity\Produit",inversedBy:"produit")]
    #[ORM\JoinColumn(nullable:false)]
    private ?int $id_produit = null;


    public function getIdCategorie(): ?int
    {
        return $this->id_categorie;
    }

    public function getIdProduit(): ?int
    {
        return $this->id_produit;
    }

}
