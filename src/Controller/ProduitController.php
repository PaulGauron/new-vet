<?php
// src/Controller/MenuController.php
namespace App\Controller;

use App\Repository\ProduitRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Produit;

class ProduitController extends AbstractController
{
    //route
    #[Route('/produit', name: 'produit')]
    public function afficherProduits(ProduitRepository $produitRepository): Response
    {
        // Affiche 6 produits de chaque catégorie de façon aléatoire
        $produits = $produitRepository->findRandomProductsByCategoryWithMaterials();
        return $this->render('produit.html.twig', [
            'produits' => $produits,
        ]);
    }

    #[Route('/produit/robes', name: 'categorie_robes')]
    public function afficherRobes(ProduitRepository $produitRepository): Response
    {
        // Appel de la méthode findAllDresses depuis le repository
        $robes = $produitRepository->findAllDresses();

        return $this->render('categorieRobes.html.twig', [
            'robes' => $robes,
        ]);
    }

    #[Route('/produit/tops', name: 'categorie_tops')]
    public function afficherTops(ProduitRepository $produitRepository): Response
    {
        // Appel de la méthode findAllTops depuis le repository
        $tops = $produitRepository->findAllTops();

        return $this->render('categorieTops.html.twig', [
            'tops' => $tops,
        ]);
    }

    #[Route('/produit/pantalons', name: 'categorie_pantalons')]
    public function afficherPantalons(ProduitRepository $produitRepository): Response
    {
        // Appel de la méthode findAllPants depuis le repository
        $pantalons = $produitRepository->findAllPants();

        return $this->render('categoriePantalons.html.twig', [
            'pantalons' => $pantalons,
        ]);
    }

    #[Route('/produit/vestes', name: 'categorie_vestes')]
    public function afficherVestes(ProduitRepository $produitRepository): Response
    {
        // Appel de la méthode findAllJackets depuis le repository
        $vestes = $produitRepository->findAllJackets();

        return $this->render('categorieVestes.html.twig', [
            'vestes' => $vestes,
        ]);
    }

    #[Route('/produit/chaussures', name: 'categorie_chaussures')]
    public function afficherChaussures(ProduitRepository $produitRepository): Response
    {
        // Appel de la méthode findAllShoes depuis le repository
        $chaussures = $produitRepository->findAllShoes();

        return $this->render('categorieChaussures.html.twig', [
            'chaussures' => $chaussures,
        ]);
    }

    #[Route('/produit/accessoires', name: 'categorie_accessoires')]
    public function afficherAccessoires(ProduitRepository $produitRepository): Response
    {
        // Appel de la méthode findAllAccessories depuis le repository
        $accessoires = $produitRepository->findAllAccessories();

        return $this->render('categorieAccessoires.html.twig', [
            'accessoires' => $accessoires,
        ]);
    }

    #[Route('/produit/{id}', name: 'produit_details')]
    public function afficherDetailsProduit(Produit $produit, ProduitRepository $produitRepository): Response
    {
        // Utilisation de la catégorie du produit pour récupérer des produits similaires
        $categorie = $produit->getCategorie();
        $produitsSimilaires = $produitRepository->findRandomProductsByCategoryWithMaterials($categorie->getId(), $produit->getId());
    
        return $this->render('detailsProduit.html.twig', [
            'produit' => $produit,
            'produitsSimilaires' => $produitsSimilaires,
        ]);
    }
    

}
