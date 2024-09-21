<?php

namespace App\Repository;

use App\Entity\Commandes;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class CommandesRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Commandes::class);
    }

    public function findAllWithDetails()
    {
        return $this->createQueryBuilder('c')
            // Jointure avec l'utilisateur lié à la commande
            ->leftJoin('c.id_util', 'u')
            ->addSelect('u')
            
            // Jointure avec la relation ProduitCommandes (produits liés à la commande)
            ->leftJoin('c.produitCommande', 'pc')
            ->addSelect('pc')
            
            // Jointure avec l'entité Produit liée à ProduitCommandes
            ->leftJoin('pc.id_produit', 'p')
            ->addSelect('p')
            
            ->getQuery()
            ->getResult();
    }
    

    // public function findAllWithDetails(): array
    // {
    //     return $this->createQueryBuilder('c')
    //         ->select('c', 'dc', 'u', 'pc')
    //         ->join('c.id_util', 'u') // Utilisateur lié à la commande
    //         ->join('c.id_com', 'dc') // Détails de la commande
    //         ->join('c.produitCommande', 'pc') // Produits liés à la commande
    //         ->getQuery()
    //         ->getResult();
    // }    
}
