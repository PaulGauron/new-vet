<?php

namespace App\Repository;

use App\Entity\Client;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Client>
 */
class ClientRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Client::class);
    }


    public function findInfosClientById(int $id): array
    {
        // Creating a query builder instance
        $qb = $this->createQueryBuilder('c')
            ->select('a.libelle_voie', 'a.code_postal', 'a.ville', 'a.pays', 'c.nom', 'c.prenom', 'a.id')
            ->join('c.client_adresse', 'ac') // Join the AdresseClient relation
            ->join('ac.id_adresse', 'a') // Join the Adresse relation through AdresseClient
            ->where('c.id = :id')
            ->setParameter('id', $id);

        // Return the results
        return $qb->getQuery()->getResult();
    }

    
    //    /**
    //     * @return Client[] Returns an array of Client objects
    //     */
    //    public function findByExampleField($value): array
    //    {
    //        return $this->createQueryBuilder('c')
    //            ->andWhere('c.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->orderBy('c.id', 'ASC')
    //            ->setMaxResults(10)
    //            ->getQuery()
    //            ->getResult()
    //        ;
    //    }

    //    public function findOneBySomeField($value): ?Client
    //    {
    //        return $this->createQueryBuilder('c')
    //            ->andWhere('c.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
}
