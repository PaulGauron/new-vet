<?php

namespace App\Repository;

use App\Entity\ProduitMateriaux;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<ProduitMateriaux>
 */
class ProduitMateriauxRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ProduitMateriaux::class);
    }

    public function deleteMateriauxProduitById($id)
    {
        $entityManager = $this->getEntityManager();

        // Construire la requête avec QueryBuilder
        $qb = $entityManager->createQueryBuilder();

        $qb->delete('App\Entity\ProduitMateriaux', 'pm')
            ->where('pm.id_produit = :id') // Condition sur l'ID
            ->setParameter('id', $id);

        // Exécuter la requête
        return $qb->getQuery()->execute();
    }

    //    /**
    //     * @return ProduitMateriaux[] Returns an array of ProduitMateriaux objects
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

    //    public function findOneBySomeField($value): ?ProduitMateriaux
    //    {
    //        return $this->createQueryBuilder('p')
    //            ->andWhere('p.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
}
