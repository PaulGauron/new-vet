<?php

namespace App\Entity;

use App\Repository\CorrespondRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CorrespondRepository::class)]
class Correspond
{
    
    #[ORM\Id]
    #[ORM\ManyToOne(targetEntity:"App\Entity\Commandes",inversedBy:"concernes")]
    #[ORM\JoinColumn(nullable:false)]
    private ?int $id_commandes = null;

    #[ORM\Id]
    #[ORM\ManyToOne(targetEntity:"App\Entity\Adresse",inversedBy:"adresse")]
    #[ORM\JoinColumn(nullable:false)]
    private ?int $id_adresse = null;

    public function getIdCommande(): ?int
    {
        return $this->id_commandes;
    }

    public function getIdAdresse(): ?int
    {
        return $this->id_adresse;
    }

}
