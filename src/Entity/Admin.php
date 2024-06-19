<?php

namespace App\Entity;

use App\Repository\AdminRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: AdminRepository::class)]
class Admin extends Utilisateur
{

    #[ORM\Column]
    private ?bool $acces = null;


    public function isAcces(): ?bool
    {
        return $this->acces;
    }

    public function setAcces(bool $acces): static
    {
        $this->acces = $acces;

        return $this;
    }
}
