<?php

namespace App\Entity;

use App\Repository\CorrespondRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CorrespondRepository::class)]
class Correspond
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id_commande = null;

    #[ORM\Column]
    private ?int $id_adresse = null;

    public function getIdCommande(): ?int
    {
        return $this->id_commande;
    }

    public function setIdCommande(int $id_commande): static
    {
        $this->id_commande = $id_commande;

        return $this;
    }

    public function getIdAdresse(): ?int
    {
        return $this->id_adresse;
    }

    public function setIdAdresse(int $id_adresse): static
    {
        $this->id_adresse = $id_adresse;

        return $this;
    }
}
