<?php

namespace App\Controller\BOController;

use App\Repository\CommandesRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class BOlisteCommandeController extends AbstractController
{
    #[Route('/BO/BOlisteCommande', name: 'BOlisteCommande')]
    public function index(CommandesRepository $commandesRepository): Response
    {
        // Récupérer toutes les commandes
        $commandes = $commandesRepository->findAllWithDetails();

        return $this->render('BO/BOlisteCommande.html.twig', [
            'commandes' => $commandes,
        ]);
    }
}
