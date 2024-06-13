<?php

namespace App\Controller;

use App\Entity\Produit;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class InscriptionController extends AbstractController
{
    //route
    #[Route('/inscription')]

    /*public function connexion()
    {

        return $this->render('/inscription/inscriptionpage.html.twig');
    }*/

    public function createUser(EntityManagerInterface $entityManager): Response
    {
        $produit = new Produit();
        $produit->setNomProd('Keyboard');
        $produit->setPrixProd(1999);
        $produit->setDescriptionProd('Ergonomic and stylish!');
        $produit->setEnStock(50);
        $produit->setDisponibilite(1);
        $produit->setIdProduit(1);

        // tell Doctrine you want to (eventually) save the Product (no queries yet)
        $entityManager->persist($produit);

        // actually executes the queries (i.e. the INSERT query)
        $entityManager->flush();

        return new Response('Saved new product with id '.$produit->getId());
    }
}