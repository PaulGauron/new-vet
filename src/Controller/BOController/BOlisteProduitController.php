<?php

namespace App\Controller\BOController;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Produit;
use App\Form\ProduitType;
use App\Repository\ProduitRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Request;


class BOlisteProduitController extends AbstractController
{

    #[Route('/BO/ProductList', name: 'BO/ProductList')]
    public function index(ProduitRepository $produitRepository): Response
    {
        {
            // Récupérer tous les produits
           $produits = $produitRepository->findAll();

    
            // Passer les produits à la vue
            return $this->render('/BO/BOlisteProduit.html.twig',[
                'produits' => $produits,
            ]);
        }
        
    }

    #[Route('/BO/ajouterProduit', name: 'BO/ajouterProduit')]
    public function addPersonne(Request $request, ManagerRegistry $doctrine): Response
    {
        $entityManager = $doctrine->getManager();
        $produit = new Produit;

        $form = $this->createForm(ProduitType::class, $produit);
        $form->handleRequest($request);
        $produit = $form->getData();
        dump($produit);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($produit);
            $entityManager->flush();

            return $this->redirectToRoute('BO/ProductList');
        }

        return $this->render('/BO/BOajouterProduit.html.twig',[
            'form' => $form->createView()
        ]);
    }

}
