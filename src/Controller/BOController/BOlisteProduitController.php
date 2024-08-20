<?php

namespace App\Controller\BOController;

use App\Entity\Images;
use App\Entity\ImagesProduit;
use App\Entity\Materiaux;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Produit;
use App\Entity\ProduitMateriaux;
use App\Form\ImagesType;
use App\Form\MainAddProductType;
use App\Form\ProduitType;
use App\Repository\ProduitRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\DomCrawler\Image;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\String\Slugger\SluggerInterface;
use Symfony\Component\HttpFoundation\File\UploadedFile;




class BOlisteProduitController extends AbstractController
{

    #[Route('/BO/ProductList', name: 'BO/ProductList')]
    public function index(ProduitRepository $produitRepository): Response
    { {
            // Récupérer tous les produits
            $produits = $produitRepository->findAll();


            // Passer les produits à la vue
            return $this->render('/BO/BOlisteProduit.html.twig', [
                'produits' => $produits,
            ]);
        }
    }

    #[Route('/BO/ajouterProduit', name: 'BO/ajouterProduit')]
    public function addPersonne(Request $request, ManagerRegistry $doctrine, SluggerInterface $slugger): Response
    {
        $entityManager = $doctrine->getManager();
        $produit = new Produit;
        $images = new Images;
        $produitImages = new ImagesProduit;

        $form = $this->createForm(MainAddProductType::class);
        $form->handleRequest($request);



        if ($form->isSubmitted() && $form->isValid()) {
            $data = $form->getData();

            $produit = $data['produit'];
            $images = $data['images'];

            /** @var UploadedFile $imageFile */
            $imageFile = $form->get('images')->get('image')->getData();
            if ($imageFile) {
                // Cette ligne est nécessaire pour inclure le nom du fichier dans l'URL
                $safeFilename = $slugger->slug($form->get('images')->get('nom_image')->getData());
                $entityManager->persist($images);
                $entityManager->flush();
                $newFilename = $safeFilename . $images->getId() . '.' . $imageFile->guessExtension();
                // Déplace le fichier dans le répertoire où les images sont stockées
                try {
                    $imageFile->move(
                        $this->getParameter('images_directory'),
                        $newFilename
                    );
                } catch (FileException $e) {
                    // Gérer l'exception si quelque chose se passe mal pendant le téléchargement du fichier
                    // Par exemple, vous pourriez ajouter un message flash ou logger l'erreur
                }
            }

            $entityManager->persist($produit);
            $entityManager->flush();

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
}
