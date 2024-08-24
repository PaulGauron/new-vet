<?php

namespace App\Entity;

use App\Repository\AdresseClientRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: AdresseClientRepository::class)]
class AdresseClient
{
    #[ORM\Id]
    #[ORM\ManyToOne(targetEntity:Client::class, inversedBy: 'adresse_client', cascade: ["persist"])]
    #[ORM\JoinColumn(nullable: false)]
    private ?Client $id_utilisateur = null;

    #[ORM\Id]
    #[ORM\ManyToOne(targetEntity:Adresse::class, inversedBy: 'adresse_client', cascade: ["persist"])]
    #[ORM\JoinColumn(nullable: false)]
    private ?Adresse $id_adresse = null;

    public function getIdUtilisateur(): ?Client
    {
        return $this->id_utilisateur;
    }

    public function setIdUtilisateur(?Client $id_utilisateur): static
    {
        $this->id_utilisateur = $id_utilisateur;

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
