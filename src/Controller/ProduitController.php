<?php
// src/Controller/MenuController.php
namespace App\Controller;

use App\Repository\ProduitRepository;
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

    #[Route('/categorie/robes', name: 'categorie_robes')]
    public function afficherRobes(ProduitRepository $produitRepository): Response
    {
        // Appel de la méthode findAllDresses depuis le repository
        $robes = $produitRepository->findAllDresses();

        return $this->render('categorieRobes.html.twig', [
            'robes' => $robes,
        ]);
    }

}
