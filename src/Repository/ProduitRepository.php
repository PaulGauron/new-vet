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

    // public function findAllDresses(): array
    // {
    //     return $this->createQueryBuilder('p')
    //         ->innerJoin('p.categorie', 'c') // Jointure avec la table categorie
    //         ->andWhere('c.id = :id_categorie') // Filtrer par l'ID de la catégorie
    //         ->setParameter('id_categorie', 1) // 1 correspond à la catégorie des robes
    //         ->getQuery()
    //         ->getResult();
    // }

/**
     * @return Produit[]
     */
    public function findAllDresses(): array
    {
        return $this->createQueryBuilder('p')
            ->innerJoin('p.images_produit', 'ip') // Jointure avec images_produit
            ->innerJoin('ip.image', 'i') // Jointure avec images
            ->andWhere('p.categorie = :categorie') // Filtrer par la catégorie
            ->setParameter('categorie', 1) // 1 correspond à la catégorie des robes
            ->getQuery()
            ->getResult();
    }
    

    public function findAllTops(): array
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.id_categorie = :id_categorie')
            ->setParameter('id_categorie', 2) // 2 correspond à la catégorie des tops
            ->getQuery()
            ->getResult();
    }

    public function findAllPants(): array
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.categorie = :categorie') // changer pour match avec notre bdd
            ->setParameter('categorie', 'pantalons') // changer pour match avec notre bdd
            ->getQuery()
            ->getResult();
    }

    public function findAllJackets(): array
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.categorie = :categorie') // changer pour match avec notre bdd
            ->setParameter('categorie', 'vestes') // changer pour match avec notre bdd
            ->getQuery()
            ->getResult();
    }

    public function findAllShoes(): array
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.categorie = :categorie') // changer pour match avec notre bdd
            ->setParameter('categorie', 'chaussures') // changer pour match avec notre bdd
            ->getQuery()
            ->getResult();
    }

    public function findAllAccessories(): array
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.categorie = :categorie') // changer pour match avec notre bdd
            ->setParameter('categorie', 'accessoires') // changer pour match avec notre bdd
            ->getQuery()
            ->getResult();
    }

    //    /**
    //     * @return Produit[] Returns an array of Produit objects
    //     */
    //    public function findByExampleField($value): array
    //    {
    //        return $this->createQueryBuilder('p')
    //            ->andWhere('p.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->orderBy('p.id', 'ASC')
    //            ->setMaxResults(10)
    //            ->getQuery()
    //            ->getResult()
    //        ;
    //    }

    //    public function findOneBySomeField($value): ?Produit
    //    {
    //        return $this->createQueryBuilder('p')
    //            ->andWhere('p.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
}
