<?php

namespace App\Entity;

use App\Repository\ClientRepository;
use DateTime;
use DateTimeInterface;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ClientRepository::class)]
class Client extends Utilisateur
{

    #[ORM\Column(length: 50, nullable: true)]
    private ?string $methode_paiement = null;

    #[ORM\Column(length: 50, nullable:true)]
    private ?string $nom_carte = null;

    #[ORM\Column(length: 255, nullable:true)]
    private ?string $numero_carte = null;

    #[ORM\Column(type: 'datetime', nullable: true)]
    private ?DateTimeInterface $date_expiration_carte = null;

    #[ORM\Column(length: 255, nullable:true)]
    private ?string $CVV = null;

    /**
     * @var Collection<int, AdresseClient>
     */
    #[ORM\OneToMany(targetEntity: AdresseClient::class, mappedBy: 'id_utilisateur', orphanRemoval: true)]
    private Collection $client_adresse;

    public function __construct()
    {
        parent::__construct();
        $this->client_adresse = new ArrayCollection();
    }

    public function getMethodePaiement(): ?string
    {
        return $this->methode_paiement;
    }

    public function setMethodePaiement(string $methode_paiement): static
    {
        $this->methode_paiement = $methode_paiement;

        return $this;
    }

    public function getNomCarte(): ?string
    {
        return $this->nom_carte;
    }

    public function setNomCarte(string $nom_carte): static
    {
        $this->nom_carte = $nom_carte;

        return $this;
    }

    public function getNumeroCarte(): ?string
    {
        return $this->numero_carte;
    }

    public function setNumeroCarte(string $numero_carte): static
    {
        $this->numero_carte = $numero_carte;

        return $this;
    }

    public function setDateExpirationCarte(?\DateTimeInterface $date_expiration_carte): self
    {
        $this->date_expiration_carte = $date_expiration_carte;

        return $this;
    }

    public function getDateExpirationCarte(): ?\DateTimeInterface
    {
        return $this->date_expiration_carte;
    }

    public function getCVV(): ?string
    {
        return $this->CVV;
    }

    public function setCVV(string $CVV): static
    {
        $this->CVV = $CVV;

        return $this;
    }

    /**
     * @return Collection<int, AdresseClient>
     */
    public function getAdresseClient(): Collection
    {
        return $this->client_adresse;
    }

    public function addAdresseClient(AdresseClient $adresseClient): static
    {
        if (!$this->client_adresse->contains($adresseClient)) {
            $this->client_adresse->add($adresseClient);
            $adresseClient->setIdUtilisateur($this);
        }

        return $this;
    }

    public function removeAdresseClient(AdresseClient $adresseClient): static
    {
        if ($this->client_adresse->removeElement($adresseClient)) {
            // set the owning side to null (unless already changed)
            if ($adresseClient->getIdUtilisateur() === $this) {
                $adresseClient->setIdUtilisateur(null);
            }
        }

        return $this;
    }

    public function __toString(): string
    {
        return 'nom : '. $this->getNom() . ' prenom ' . $this->getPrenom() .' id :'. $this->getId() . ' Email : ' . $this->getEmail();
    }
}
