<?php

namespace App\Controller\BOController;

use App\Entity\Images;
use App\Entity\ImagesProduit;
use App\Entity\Materiaux;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Produit;
use App\Entity\ProduitCommandes;
use App\Entity\ProduitMateriaux;
use App\Form\ImagesType;
use App\Form\MainAddProductType;
use App\Form\MainModifyProductType;
use App\Form\ProduitType;
use App\Repository\ProduitRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\DomCrawler\Image;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\String\Slugger\SluggerInterface;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\Session\SessionInterface;




class BOlisteProduitController extends AbstractController
{

      // Vérifie si l'utilisateur est admin
      private function checkAdmin(SessionInterface $session): ?Response
      {
          $userId = $session->get('utilisateur'); 
  
          
          $userRole = $session->get('user_role'); // Suppose que le rôle utilisateur est stocké dans la session
          if (!$userId || $userRole !== 'admin') {
              return $this->redirectToRoute('accueil'); // Redirigez vers l'accueil si l'utilisateur n'est pas admin
          }
  
          return null; // Retourne null si l'utilisateur est admin
      }

    #[Route('/BO/ProductList', name: 'BO/ProductList')]
    public function index(ProduitRepository $produitRepository, SessionInterface $session): Response
    {
        if ($response = $this->checkAdmin($session)) {
            return $response;
        }
        
            // Récupérer tous les produits
            $produits = $produitRepository->findAll();


            // Passer les produits à la vue
            return $this->render('/BO/BOlisteProduit.html.twig', [
                'produits' => $produits,
            ]);
    }

    #[Route('/BO/ajouterProduit', name: 'BO/ajouterProduit')]
    public function addProduit(Request $request, ManagerRegistry $doctrine, SluggerInterface $slugger, SessionInterface $session): Response
    {
        if ($response = $this->checkAdmin($session)) {
            return $response;
        }

        $entityManager = $doctrine->getManager();
        $produit = new Produit;
        $images = new Images;
        $produitImages = new ImagesProduit;

        $form = $this->createForm(MainAddProductType::class);
        $form->handleRequest($request);


        if ($form->isSubmitted() && $form->isValid()) {
            $data = $form->getData();
            $listeMateriaux = $form->get('produit')->get('materiaux')->getData();
            $produit = $data['produit'];
            $images = $data['images'];
            $imageFile = $form->get('images')->get('image')->getData();
           // dd($listeMateriaux);

            if ($imageFile) {
                $safeFilename = $slugger->slug($images->getNomImage() . '-' . uniqid());
                $newFilename = $safeFilename . '.' . $imageFile->guessExtension();

                try {
                    $imageFile->move(
                        $this->getParameter('images_directory'),
                        $newFilename
                    );
                } catch (FileException $e) {
                    // Gérer l'exception si quelque chose se passe mal pendant le téléchargement du fichier
                }

                $images->setNomImage($safeFilename);
            }
           
            $entityManager->persist($produit);

            foreach( $listeMateriaux as $materiaux){
                $produitMateriaux = new ProduitMateriaux;
                $produitMateriaux->setIdMateriaux($materiaux);
                $produitMateriaux->setIdProduit($produit);
                $entityManager->persist($produitMateriaux);                
            }            

            $entityManager->persist($images);
            // Associer Produit et Images via ImagesProduit
            $produitImages->setProduit($produit);
            $produitImages->setImage($images);

            // Persister et flush l'entité ImagesProduit
            $entityManager->persist($produitImages);
            $entityManager->flush();

            return $this->redirectToRoute('BO/ProductList');
        }
        return $this->render('/BO/BOajouterProduit.html.twig', [
            'form' => $form->createView()
        ]);
    }


    #[Route('/BO/modifierProduit/{id}', name: 'BO/modifierProduit')]
    public function modifProduit(int $id, Request $request, ManagerRegistry $doctrine, SluggerInterface $slugger, SessionInterface $session): Response
    {

        if ($response = $this->checkAdmin($session)) {
            return $response;
        }

        $entityManager = $doctrine->getManager();
        $produit = $entityManager->getRepository(Produit::class)->findAllById($id);
        if (!$produit) {
            throw $this->createNotFoundException(
                'No product found for id ' . $id
            );
        }

        $form = $this->createForm(MainModifyProductType::class,$produit);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $imageFile = $form->get('images')->get('image')->getData();
            $directory = $this->getParameter('images_directory');

            if ($imageFile) {
                foreach ($produit[0]->getImagesProduits() as $imagesProduit) {
                    // Get the associated Image entity
                    $image = $imagesProduit->getImage();
                    $Filename = $image->getNomImage(). '.' .$imageFile->guessExtension();
                    $newFilename = $Filename;
                    // Handle the image upload
                    if ($Filename) {
                        $FilePath = $directory . '/' . $Filename;
                        if (file_exists($FilePath)) {
                            unlink($FilePath);
                        }
                    }
                    try {
                        // Move the new image file to the specified directory
                        $imageFile->move(
                            $directory,
                            $newFilename
                        );
                    } catch (FileException $e) {
                        // Handle the exception if something goes wrong during file upload
                        throw new \RuntimeException('An error occurred while uploading the file.', 0, $e);
                    }
                }
            }

            $entityManager->flush();

            return $this->redirectToRoute('BO/ProductList');
        }



        return $this->render('/BO/BOmodifProduit.html.twig', [
            'form' => $form->createView(),
            'produit' => $produit,

        ]);
    }


    #[Route('/BO/supprimerProduit/{id}', name: 'BO/supprimerProduit')]
    public function supprimerProduit(int $id, ProduitRepository $produitRepository,  ManagerRegistry $doctrine, SessionInterface $session): Response
    {
        if ($response = $this->checkAdmin($session)) {
            return $response;
        }
        // Trouve le produit par son ID
        $produit = $produitRepository->findAllById($id);
        $dateActuelle = new \DateTime();
        $dateMax = $dateActuelle->modify('-3 years')->format('Y');
        $entityManager = $doctrine->getManager();
        $produitCommandes = $entityManager->getRepository(ProduitCommandes::class)->findCommandProduct($id);
        $commandeMoinsde3an = false;
        foreach($produitCommandes as $produitCommande){
        $detailsCommandes = $produitCommande->getCommande()->getIdCom();
            foreach($detailsCommandes as $detailsCommande){
               // dd($detailsCommande->getDateCommande()->format('Y') < $dateMax);
               if($detailsCommande->getDateCommande()->format('Y') > $dateMax ){
                $commandeMoinsde3an = true;
               }else{
                $commandeMoinsde3an = false;
               }
            }
        }
        if($produitCommandes && $commandeMoinsde3an ){
                $this->addFlash('error', 'le produit a une commande en cours de moins de 3ans. Vous ne pouvez pas le supprimer');
        }else if($produit){            
            // Supprime le produit
           
            $directory = $this->getParameter('images_directory');

            foreach ($produit[0]->getImagesProduits() as $imagesProduit) {
                // Get the associated Image entity
                $image = $imagesProduit->getImage();
                $Filename = $image->getNomImage(). '.jpg';
                // Handle the image upload
                if ($Filename) {
                    $FilePath = $directory . '/' . $Filename;
                    if (file_exists($FilePath)) {
                        unlink($FilePath);
                    }
                }
            }

            $produitRepository->deleteProduit($produit[0]);
            // Ajoute un message de confirmation
            $this->addFlash('success', 'Produit supprimé avec succès.');
        }else{
            $this->addFlash('error', 'le produit n\'existe pas .');
        }   

        return $this->redirectToRoute('BO/ProductList');
    }

    #[Route('/BO/tableauBord', name: 'BO/tableauBord')]
    public function tableaudeBord(ManagerRegistry $doctrine): Response
    {

        return $this->render('/BO/BOtableauBord.html.twig');
    }


    
}
