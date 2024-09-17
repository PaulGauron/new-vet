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
use App\Repository\CommandesRepository;
use App\Repository\ProduitRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\DomCrawler\Image;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\String\Slugger\SluggerInterface;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\Session\SessionInterface;




class BOlisteCommandeController extends AbstractController
{
    private function checkAdmin(SessionInterface $session): ?Response
    {
        $userId = $session->get('utilisateur'); 

        
        $userRole = $session->get('user_role'); // Suppose que le rôle utilisateur est stocké dans la session
        if (!$userId || $userRole !== 'admin') {
            return $this->redirectToRoute('accueil'); // Redirigez vers l'accueil si l'utilisateur n'est pas admin
        }

        return null; // Retourne null si l'utilisateur est admin
    }

    #[Route('/BO/CommandList', name: 'BO/CommandList')]
    public function index(CommandesRepository $commandesRepository, SessionInterface $session): Response
    {
        if ($response = $this->checkAdmin($session)) {
            return $response;
        }

        $commandes = $commandesRepository->findAll();

        return $this->render('/BO/BOlisteCommande.html.twig', [
            'commandes' => $commandes,
        ]);
    }




}