<?php

namespace App\Repository;

use App\Entity\Produit;
use App\Entity\Categorie;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\ORM\QueryBuilder;

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

    public function findAll(): array
    {
        return $this->createQueryBuilder('p')
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

    
    public function findRandomProductsByCategoryWithMaterials(int $selectedCategory, int $selectedProductId): array
    {
        // Récupère tous les produits pour la catégorie sélectionnée avec leurs matériaux, exclue le produit sélectionné
        $products = $this->createQueryBuilder('p')
            ->leftJoin('p.produit_materiaux', 'pm') // Joindre la relation ProduitMateriaux
            ->leftJoin('pm.id_materiaux', 'm') // Joindre la relation Materiaux
            ->addSelect('pm', 'm') // Sélectionner les matériaux
            ->where('p.categorie = :category')
            ->andWhere('p.id != :selectedProductId') // Exclure le produit sélectionné
            ->setParameter('category', $selectedCategory)
            ->setParameter('selectedProductId', $selectedProductId)
            ->getQuery()
            ->getResult();
    
        // Mélange les produits et prend les 6 premiers
        shuffle($products);
        $results = array_slice($products, 0, 6);
    
        return $results;
    }
    
    public function search(?string $title, ?string $description, ?string $materiaux, ?float $prixMin, ?float $prixMax, $categories, ?bool $inStock, ?string $sort)
    {
        $qb = $this->createQueryBuilder('p')
            ->leftJoin('p.produit_materiaux', 'pm')
            ->leftJoin('pm.id_materiaux', 'm')
            ->where('1=1');

        if ($title) {
            $qb->andWhere('p.nom_prod LIKE :title')
                ->setParameter('title', '%' . $title . '%');
        }

        if ($description) {
            $qb->andWhere('p.description_prod LIKE :description')
                ->setParameter('description', '%' . $description . '%');
        }

        if ($materiaux) {
            $qb->andWhere('m.nom__mat LIKE :materiaux')
                ->setParameter('materiaux', '%' . $materiaux . '%');
        }

        if ($prixMin) {
            $qb->andWhere('p.prix_prod >= :prixMin')
                ->setParameter('prixMin', $prixMin);
        }

        if ($prixMax) {
            $qb->andWhere('p.prix_prod <= :prixMax')
                ->setParameter('prixMax', $prixMax);
        }

        if ($categories) {
            $qb->andWhere('p.categorie IN (:categories)')
                ->setParameter('categories', $categories);
        }

        if ($inStock !== null) {
            if ($inStock) {
                $qb->andWhere('p.stock > 3');
            }
        }

        if ($sort) {
            switch ($sort) {
                case 'price_asc':
                    $qb->orderBy('p.prix_prod', 'ASC');
                    break;
                case 'price_desc':
                    $qb->orderBy('p.prix_prod', 'DESC');
                    break;
                // pas établi
                // case 'newest':
                //     $qb->orderBy('p.dateAjout', 'DESC');
                //     break;
                case 'in_stock':
                    $qb->orderBy('p.stock', 'DESC');
                    break;
            }
        }

        return $qb->getQuery()->getResult();
    }

    public function findAllCategories()
    {
        // Retourne toutes les catégories
        return $this->getEntityManager()->getRepository(Categorie::class)->findAll();
    }

}