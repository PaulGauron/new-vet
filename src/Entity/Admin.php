<?php

namespace App\Entity;

use App\Repository\AdminRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: AdminRepository::class)]
class Admin extends Utilisateur
{

    #[ORM\Column(nullable:true)]
    private ?int $acces = null;


    public function isAcces(): ?int
    {
        return $this->acces;
    }

    public function setAcces(int $acces): static
    {
        $this->acces = $acces;

        return $this;
    }
}
