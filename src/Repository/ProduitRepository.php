<?php

namespace App\Repository;

use App\Entity\Produit;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Produit>
 */
class ProduitRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Produit::class);
    }

/**
     * @return Produit[]
     */
    public function findAllDresses(): array
    {
        return $this->createQueryBuilder('p')
            ->innerJoin('p.imagesProduits', 'ip') // Jointure avec images_produit
            ->innerJoin('ip.image', 'i') // Jointure avec images
            ->andWhere('p.categorie = :categorie') // Filtrer par la catégorie
            ->setParameter('categorie', 1) // 1 correspond à la catégorie des robes
            ->orderBy('p.ordre', 'DESC') // Tri par le champ ordre en ordre décroissant
            ->getQuery()
            ->getResult();
    }
    
    

    public function findAllTops(): array
    {
        return $this->createQueryBuilder('p')
            ->innerJoin('p.imagesProduits', 'ip') // Jointure avec images_produit
            ->innerJoin('ip.image', 'i') // Jointure avec images
            ->andWhere('p.categorie = :categorie') // Filtrer par la catégorie
            ->setParameter('categorie', 2) // 2 correspond à la catégorie des tops
            ->orderBy('p.ordre', 'DESC') // Tri par le champ ordre en ordre décroissant
            ->getQuery()
            ->getResult();
    }

    public function findAllPants(): array
    {
        return $this->createQueryBuilder('p')
        ->innerJoin('p.imagesProduits', 'ip') // Jointure avec images_produit
        ->innerJoin('ip.image', 'i') // Jointure avec images
        ->andWhere('p.categorie = :categorie') // Filtrer par la catégorie
        ->setParameter('categorie', 3) // 3 correspond à la catégorie des pantalons
        ->orderBy('p.ordre', 'DESC') // Tri par le champ ordre en ordre décroissant
        ->getQuery()
        ->getResult();
    }

    public function findAllJackets(): array
    {
        return $this->createQueryBuilder('p')
        ->innerJoin('p.imagesProduits', 'ip') // Jointure avec images_produit
        ->innerJoin('ip.image', 'i') // Jointure avec images
        ->andWhere('p.categorie = :categorie') // Filtrer par la catégorie
        ->setParameter('categorie', 4) // 4 correspond à la catégorie des vestes
        ->orderBy('p.ordre', 'DESC') // Tri par le champ ordre en ordre décroissant
        ->getQuery()
        ->getResult();
    }

    public function findAllShoes(): array
    {
        return $this->createQueryBuilder('p')
        ->innerJoin('p.imagesProduits', 'ip') // Jointure avec images_produit
        ->innerJoin('ip.image', 'i') // Jointure avec images
        ->andWhere('p.categorie = :categorie') // Filtrer par la catégorie
        ->setParameter('categorie', 5) // 5 correspond à la catégorie des chaussures
        ->orderBy('p.ordre', 'DESC') // Tri par le champ ordre en ordre décroissant
        ->getQuery()
        ->getResult();
    }

    public function findAllAccessories(): array
    {
        return $this->createQueryBuilder('p')
        ->innerJoin('p.imagesProduits', 'ip') // Jointure avec images_produit
        ->innerJoin('ip.image', 'i') // Jointure avec images
        ->andWhere('p.categorie = :categorie') // Filtrer par la catégorie
        ->setParameter('categorie', 6) // 6 correspond à la catégorie des accessoires
        ->orderBy('p.ordre', 'DESC') // Tri par le champ ordre en ordre décroissant
        ->getQuery()
        ->getResult();
    }

}
