<?php

namespace App\Entity;

use App\Repository\AdresseCommandesRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: AdresseCommandesRepository::class)]
class AdresseCommandes
{
    
    #[ORM\Id]
    #[ORM\ManyToOne(inversedBy: 'id_commande')]
    #[ORM\JoinColumn(nullable: false)]
    private ?commandes $id_commandes = null;

    #[ORM\Id]
    #[ORM\ManyToOne(inversedBy: 'id_adresse')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Adresse $id_adresse = null;

   
    public function getIdCommandes(): ?commandes
    {
        return $this->id_commandes;
    }

    public function setIdCommandes(?commandes $id_commandes): static
    {
        $this->id_commandes = $id_commandes;

        return $this;
    }

    public function getIdAdresse(): ?Adresse
    {
        return $this->id_adresse;
    }

    public function setIdAdresse(?Adresse $id_adresse): static
    {
        $this->id_adresse = $id_adresse;

        return $this;
    }
}
