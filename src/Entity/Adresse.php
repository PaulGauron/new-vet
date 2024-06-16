<?php

namespace App\Entity;

use App\Repository\AdresseRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: AdresseRepository::class)]
class Adresse
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id_adresse = null;

    #[ORM\Column(length: 255)]
    private ?string $libelle_voie = null;

    #[ORM\Column]
    private ?int $code_postal = null;

    #[ORM\Column(length: 255)]
    private ?string $ville = null;

    #[ORM\Column(length: 255)]
    private ?string $type_adresse = null;

    #[ORM\Column(length: 255)]
    private ?string $preference = null;

    public function getId(): ?int
    {
        return $this->id_adresse;
    }

    public function getLibelleVoie(): ?string
    {
        return $this->libelle_voie;
    }

    public function setLibelleVoie(string $libelle_voie): static
    {
        $this->libelle_voie = $libelle_voie;

        return $this;
    }

    public function getCodePostal(): ?int
    {
        return $this->code_postal;
    }

    public function setCodePostal(int $code_postal): static
    {
        $this->code_postal = $code_postal;

        return $this;
    }

    public function getVille(): ?string
    {
        return $this->ville;
    }

    public function setVille(string $ville): static
    {
        $this->ville = $ville;

        return $this;
    }

    public function getTypeAdresse(): ?string
    {
        return $this->type_adresse;
    }

    public function setTypeAdresse(string $type_adresse): static
    {
        $this->type_adresse = $type_adresse;

        return $this;
    }

    public function getPreference(): ?string
    {
        return $this->preference;
    }

    public function setPreference(string $preference): static
    {
        $this->preference = $preference;

        return $this;
    }
}
