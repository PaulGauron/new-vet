<?php

namespace App\Entity;

use App\Repository\AdresseRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: AdresseRepository::class)]
class Adresse
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $libelle_voie = null;

    #[ORM\Column]
    private ?int $code_postal = null;

    #[ORM\Column(length: 100)]
    private ?string $ville = null;

    #[ORM\Column(length: 50 , nullable:true)]
    private ?string $type_adresse = null;

    #[ORM\Column(length: 50, nullable:true)]
    private ?string $preference = null;

    #[ORM\Column(length: 50)]
    private ?string $pays = null;



    /**
     * @var Collection<int, AdresseClient>
     */
    #[ORM\OneToMany(targetEntity: AdresseClient::class, mappedBy: 'id_adresse', orphanRemoval: true)]
    private Collection $adresse_client;

    /**
     * @var Collection<int, Commandes>
     */
    #[ORM\OneToMany(targetEntity: Commandes::class, mappedBy: 'id_adresse')]
    private Collection $commandes_adresse;

   

    public function __construct()
    {
        $this->adresse_client = new ArrayCollection();
        $this->commandes_adresse = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
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

    public function getPays(): ?string
    {
        return $this->pays;
    }

    public function setPays(string $pays): static
    {
        $this->pays = $pays;

        return $this;
    }



    /**
     * @return Collection<int, AdresseClient>
     */
    public function getAdresseClient(): Collection
    {
        return $this->adresse_client;
    }

    public function addAdresseClient(AdresseClient $adresseClient): static
    {
        if (!$this->adresse_client->contains($adresseClient)) {
            $this->adresse_client->add($adresseClient);
            $adresseClient->setIdAdresse($this);
        }

        return $this;
    }

    public function removeAdresseClient(AdresseClient $adresseClient): static
    {
        if ($this->adresse_client->removeElement($adresseClient)) {
            // set the owning side to null (unless already changed)
            if ($adresseClient->getIdAdresse() === $this) {
                $adresseClient->setIdAdresse(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Commandes>
     */
    public function getCommandesAdresse(): Collection
    {
        return $this->commandes_adresse;
    }

    public function addCommandesAdresse(Commandes $commandesAdresse): static
    {
        if (!$this->commandes_adresse->contains($commandesAdresse)) {
            $this->commandes_adresse->add($commandesAdresse);
            $commandesAdresse->setIdAdresse($this);
        }

        return $this;
    }

    public function removeCommandesAdresse(Commandes $commandesAdresse): static
    {
        if ($this->commandes_adresse->removeElement($commandesAdresse)) {
            // set the owning side to null (unless already changed)
            if ($commandesAdresse->getIdAdresse() === $this) {
                $commandesAdresse->setIdAdresse(null);
            }
        }

        return $this;
    }

}
