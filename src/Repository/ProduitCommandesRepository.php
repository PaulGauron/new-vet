<?php

namespace App\Repository;

use App\Entity\ProduitCommandes;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<ProduitCommandes>
 */
class ProduitCommandesRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ProduitCommandes::class);
    }


    public function findCommandProduct($id): array
    {
        return $this->createQueryBuilder('pc')
            ->where('pc.id_produit = :idProd')
            ->setParameter('idProd', $id)
            ->getQuery()
            ->getResult();
    }

    public function deleteByIdCommande($id)
    {
        $entityManager = $this->getEntityManager();

        // Construire la requête avec QueryBuilder
        $qb = $entityManager->createQueryBuilder();

        $qb->delete('App\Entity\ProduitCommandes', 'pc')
            ->where('pc.commande = :id') // Condition sur l'ID
            ->setParameter('id', $id);

        // Exécuter la requête
        return $qb->getQuery()->execute();
    }

    //    /**
    //     * @return ProduitCommandes[] Returns an array of ProduitCommandes objects
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

    //    public function findOneBySomeField($value): ?ProduitCommandes
    //    {
    //        return $this->createQueryBuilder('p')
    //            ->andWhere('p.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
}
