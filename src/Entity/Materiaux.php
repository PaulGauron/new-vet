<?php

namespace App\Entity;

use App\Repository\MateriauxRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: MateriauxRepository::class)]
class Materiaux
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?int $id_materiaux = null;

    #[ORM\Column(length: 255)]
    private ?string $nom_mat = null;

    public function getId(): ?int
    {
        return $this->id;
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

    public function getNomMat(): ?string
    {
        return $this->nom_mat;
    }

    public function setNomMat(string $nom_mat): static
    {
        $this->nom_mat = $nom_mat;

        return $this;
    }
}
