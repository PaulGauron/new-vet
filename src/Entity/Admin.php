<?php

namespace App\Entity;

use App\Repository\AdminRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: AdminRepository::class)]
class Admin extends Utilisateur
{    

    #[ORM\Column]
    private ?bool $access = null;

   
    public function isAccess(): ?bool
    {
        return $this->access;
    }

    public function setAccess(bool $access): static
    {
        $this->access = $access;

        return $this;
    }
}
