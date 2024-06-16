<?php

namespace App\Entity;

use App\Repository\UtiliserRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: UtiliserRepository::class)]
class Utiliser
{
   
    #[ORM\Id]
    #[ORM\ManyToOne(targetEntity:"App\Entity\Produit",inversedBy:"produit")]
    #[ORM\JoinColumn(nullable:false)]
    private ?int $id_produit = null;

    #[ORM\Id]
    #[ORM\ManyToOne(targetEntity:"App\Entity\Materiaux",inversedBy:"materiaux")]
    #[ORM\JoinColumn(nullable:false)]
    private ?int $id_materiaux = null;

    public function getIdProduit(): ?int
    {
        return $this->id_produit;
    }

    public function getIdMateriaux(): ?int
    {
        return $this->id_materiaux;
    }

}
