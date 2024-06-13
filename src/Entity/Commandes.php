<?php

namespace App\Entity;

use App\Repository\CommandesRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CommandesRepository::class)]
class Commandes
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?int $id_commandes = null;

    #[ORM\Column]
    private ?int $id_utilisateur = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIdCommandes(): ?int
    {
        return $this->id_commandes;
    }

    public function setIdCommandes(int $id_commandes): static
    {
        $this->id_commandes = $id_commandes;

        return $this;
    }

    public function getIdUtilisateur(): ?int
    {
        return $this->id_utilisateur;
    }

    public function setIdUtilisateur(int $id_utilisateur): static
    {
        $this->id_utilisateur = $id_utilisateur;

        return $this;
    }
}
