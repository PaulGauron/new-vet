<?php

namespace App\Controller\BOController;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Produit;

class BOlisteProduitController extends AbstractController
{

    #[Route('/ProductList', name: 'ProductList')]
    public function index(Produit $produit): Response
    {
        {
            // Récupérer tous les produits
            $produits = $produit->findAll();
    
            // Passer les produits à la vue
            return $this->render('./BO/BOlisteProduit.html.twig', [
                'produits' => $produits,
            ]);
        }
        
    }

}
