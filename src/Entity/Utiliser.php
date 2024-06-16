<?php

namespace App\Entity;

use App\Repository\UtiliserRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: UtiliserRepository::class)]
class Utiliser
{
    #[ORM\Id]
    #[ORM\GeneratedValue]

    #[ORM\Column]
    private ?int $id_produit = null;

    #[ORM\Column]
    private ?int $id_materiaux = null;

    public function getIdProduit(): ?int
    {
        return $this->id_produit;
    }

    public function setIdProduit(int $id_produit): static
    {
        $this->id_produit = $id_produit;

        return $this;
    }

    public function getIdMateriaux(): ?int
    {
        return $this->id_materiaux;
    }

    public function setIdMateriaux(int $id_materiaux): static
    {
        $this->id_materiaux = $id_materiaux;

        return $this;
    }
}
