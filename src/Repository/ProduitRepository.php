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


    // // parcours les catégories et choisi aléatoirement 6 produits par catégorie
    // public function findRandomProductsByCategory(): array
    // {
    //     $categories = [1, 2, 3, 4, 5, 6];
    //     $results = [];

    //     foreach ($categories as $category) {
    //         // Récupère tous les produits pour une catégorie spécifique
    //         $products = $this->createQueryBuilder('p')
    //             ->where('p.categorie = :category')
    //             ->setParameter('category', $category)
    //             ->getQuery()
    //             ->getResult();

    //         // Mélange les produits et prend les 6 premiers
    //         shuffle($products);
    //         $results = array_merge($results, array_slice($products, 0, 6));
    //     }
    //     // Mélange les produits des catégories du tableau
    //     shuffle($results);
    //     return $results;
    // }


    // public function findMaterialsByProduct(): array
    // {
    //     // Utilisation du QueryBuilder pour construire la requête
    //     return $this->createQueryBuilder('p')
    //         ->select('p.id, p.nom_prod, m.nom__mat')
    //         ->join('p.produit_materiaux', 'pm') // Joindre la relation ProduitMateriaux
    //         ->join('pm.id_materiaux', 'm') // Joindre la relation Materiaux
    //         ->getQuery()
    //         ->getResult();
    // }

    public function findRandomProductsByCategoryWithMaterials(): array
    {
        $categories = [1, 2, 3, 4, 5, 6];
        $results = [];
    
        foreach ($categories as $category) {
            // Récupère tous les produits pour une catégorie spécifique avec leurs matériaux
            $products = $this->createQueryBuilder('p')
                ->leftJoin('p.produit_materiaux', 'pm') // Joindre la relation ProduitMateriaux
                ->leftJoin('pm.id_materiaux', 'm') // Joindre la relation Materiaux
                ->addSelect('pm', 'm') // Sélectionner aussi les matériaux
                ->where('p.categorie = :category')
                ->setParameter('category', $category)
                ->getQuery()
                ->getResult();
    
            // Mélange les produits et prend les 6 premiers
            shuffle($products);
            $results = array_merge($results, array_slice($products, 0, 6));
        }
    
        // Mélange les produits des catégories du tableau
        shuffle($results);
        return $results;
    }
    
    
}

