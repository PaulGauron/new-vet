<?php

namespace App\Entity;

use App\Repository\ContactRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ContactRepository::class)]
class Contact
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $sujet = null;

    #[ORM\Column(length: 255)]
    private ?string $contenu = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $date_contact = null;

    #[ORM\ManyToOne(inversedBy: 'id_util')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Utilisateur $id_util = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getSujet(): ?string
    {
        return $this->sujet;
    }

    public function setSujet(string $sujet): static
    {
        $this->sujet = $sujet;

        return $this;
    }

    public function getContenu(): ?string
    {
        return $this->contenu;
    }

    public function setContenu(string $contenu): static
    {
        $this->contenu = $contenu;

        return $this;
    }

    public function getDateContact(): ?\DateTimeInterface
    {
        return $this->date_contact;
    }

    public function setDateContact(\DateTimeInterface $date_contact): static
    {
        $this->date_contact = $date_contact;

        return $this;
    }

    public function getIdUtil(): ?Utilisateur
    {
        return $this->id_util;
    }

    public function setIdUtil(?Utilisateur $id_util): static
    {
        $this->id_util = $id_util;

        return $this;
    }
}
