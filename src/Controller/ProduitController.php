<?php
// src/Controller/MenuController.php
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ProduitController extends AbstractController
{
    //route
    #[Route('/produit', name: 'produit')]
    public function produit(): Response
    {
        return $this->render('produit.html.twig');
    }

    public function findAllDresses(): array
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.categorie = :categorie') // changer pour match avec notre bdd
            ->setParameter('categorie', 'robes') // changer pour match avec notre bdd
            ->getQuery()
            ->getResult();
    }

    public function findAllTshirts(): array
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.categorie = :categorie') // changer pour match avec notre bdd
            ->setParameter('categorie', 'Tshirts') // changer pour match avec notre bdd
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

}
