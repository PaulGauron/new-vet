<?php

namespace App\Entity;

use App\Repository\EnregistreRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: EnregistreRepository::class)]
class Enregistre
{
    
    #[ORM\Id]
    #[ORM\ManyToOne(targetEntity:"App\Entity\Utilisateur",inversedBy:"utilisateur")]
    #[ORM\JoinColumn(nullable:false)]
    private ?int $id_utilisateur = null;

    #[ORM\Id]
    #[ORM\ManyToOne(targetEntity:"App\Entity\Adresse",inversedBy:"adresse")]
    #[ORM\JoinColumn(nullable:false)]
    private ?int $id_adresse = null;

    public function getIdUtilisateur(): ?int
    {
        return $this->id_utilisateur;
    }

    public function getIdAdresse(): ?int
    {
        return $this->id_adresse;
    }

}
