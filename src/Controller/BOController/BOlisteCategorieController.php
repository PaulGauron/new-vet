<?php

namespace App\Controller\BOController;

use App\Repository\CategorieRepository;
use App\Repository\CommandesRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class BOlisteCategorieController extends AbstractController
{
    #[Route('/BO/BOlisteCategorie', name: 'BO/listecategorie')]
    public function index(CategorieRepository $categorieRepository): Response
    {
        // Récupérer toutes les commandes
        $categories = $categorieRepository->findAll();

        return $this->render('BO/BOlisteCommande.html.twig', [
            'categories' => $categories,
        ]);
    }

    #[Route('/BO/SupprimerCategorie', name: 'BO/listecategorie')]
    public function supprimerCat(){

    }
}
