<?php

namespace App\Entity;

use App\Repository\DetailCommandeRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: DetailCommandeRepository::class)]
class DetailCommande
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $date_commande = null;


    #[ORM\Column]
    private ?float $prix_tot = null;

    #[ORM\ManyToOne(inversedBy: 'id_com')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Commandes $id_com = null;

    #[ORM\Column(length: 50)]
    private ?string $statut = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDateCommande(): ?\DateTimeInterface
    {
        return $this->date_commande;
    }

    public function setDateCommande(\DateTimeInterface $date_commande): static
    {
        $this->date_commande = $date_commande;

        return $this;
    }

    public function getPrixTot(): ?float
    {
        return $this->prix_tot;
    }

    public function setPrixTot(float $prix_tot): static
    {
        $this->prix_tot = $prix_tot;

        return $this;
    }

    public function getIdCom(): ?Commandes
    {
        return $this->id_com;
    }

    public function setIdCom(?Commandes $id_com): static
    {
        $this->id_com = $id_com;

        return $this;
    }

    public function getStatut(): ?string
    {
        return $this->statut;
    }

    public function setStatut(string $statut): static
    {
        $this->statut = $statut;

        return $this;
    }
}
