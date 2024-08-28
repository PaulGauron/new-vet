<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\ProduitRepository;
use App\Entity\Produit;
use Symfony\Component\HttpFoundation\Request;

use function PHPSTORM_META\type;

class AccueilController extends AbstractController
{

    #[Route('/', name: 'accueil')]
    public function index( ProduitRepository $produitRepository): Response
    {
        $highlanders = $produitRepository->findHighlander();

       /*foreach($highlanders[0]->getImagesProduits() as $imageProduit){
           $image = $imageProduit->getImage()->getNomImage();
           break;
       }

      array_push($highlanders,$image);*/
      
       // dd(gettype($highlander->getId()) );
     
      
        return $this->render('/index.html.twig', [
            'highlanders' => $highlanders,
        ]);
    }

    #[Route('/produit/highlander/{id}', name: 'highlander_details')]
    public function afficherDetailsProduitHighlander(int $id, ProduitRepository $produitRepository): Response
    {
        $produit = $produitRepository->find($id);
        // Utilisation de la catégorie du produit pour récupérer des produits similaires
        $categorie = $produit->getCategorie();
        //dd(gettype($id));
        $produitsSimilaires = $produitRepository->findRandomProductsByCategoryWithMaterials($categorie->getId(), $produit->getId());
    
        return $this->render('detailsProduit.html.twig', [
            'produit' => $produit,
            'produitsSimilaires' => $produitsSimilaires,
        ]);
    }
}
