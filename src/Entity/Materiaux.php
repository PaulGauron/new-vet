<?php

namespace App\Entity;

use App\Repository\MateriauxRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: MateriauxRepository::class)]
class Materiaux
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 50)]
    #[Assert\Type(
        type: 'string',
        message: 'La valeur {{ value }} n\'est pas valide',
    )]
    private ?string $nom__mat = null;

    /**
     * @var Collection<int, ProduitMateriaux>
     */
    #[ORM\OneToMany(targetEntity: ProduitMateriaux::class, mappedBy: 'id_materiaux', orphanRemoval: true)]
    private Collection $materiaux_produit;

    public function __construct()
    {
        $this->materiaux_produit = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomMat(): ?string
    {
        return $this->nom__mat;
    }

    public function setNomMat(string $nom__mat): static
    {
        $this->nom__mat = $nom__mat;

        return $this;
    }

    /**
     * @return Collection<int, ProduitMateriaux>
     */
    public function getMateriauxProduit(): Collection
    {
        return $this->materiaux_produit;
    }

    public function addMateriauxProduit(ProduitMateriaux $materiauxProduit): static
    {
        if (!$this->materiaux_produit->contains($materiauxProduit)) {
            $this->materiaux_produit->add($materiauxProduit);
            $materiauxProduit->setIdMateriaux($this);
        }

        return $this;
    }

    public function removeMateriauxProduit(ProduitMateriaux $materiauxProduit): static
    {
        if ($this->materiaux_produit->removeElement($materiauxProduit)) {
            // set the owning side to null (unless already changed)
            if ($materiauxProduit->getIdMateriaux() === $this) {
                $materiauxProduit->setIdMateriaux(null);
            }
        }

        return $this;
    }
}
