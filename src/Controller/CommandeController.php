<?php

namespace App\Controller;

use App\Entity\Commandes;
use App\Entity\DetailCommande;
use App\Entity\ProduitCommandes;
use App\Entity\Utilisateur;
use App\Form\ConnexionType;
use App\Repository\UtilisateurRepository;
use App\Repository\CommandesRepository;
use Doctrine\Persistence\ManagerRegistry;
use PHPUnit\TextUI\Command;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

class CommandeController extends AbstractController
{
    //route
    #[Route('/commande',name: 'Mescommande')]
    public function resumerCommandes(Request $request, ManagerRegistry $doctorine, SessionInterface $session)
    {

        $dateActuelle = new \DateTime();
        $dateMax = $dateActuelle->modify('-3 years')->format('Y');
        $entityManager = $doctorine->getManager();
        $userID = $session->get('utilisateur');
    
        // Récupérer l'utilisateur connecté
        $utilisateur = $entityManager->getRepository(Utilisateur::class)->find($userID);
    
        if (!$utilisateur) {
            throw $this->createNotFoundException('Utilisateur non trouvé');
        }
    
        // Récupérer les commandes de l'utilisateur
        $commandes = $entityManager->getRepository(Commandes::class)->findBy(['id_util' => $utilisateur]);
     
        // Préparer les données à envoyer au template
        $commandesData = [];
        foreach ($commandes as $commande) {
            $detailsCommande = $commande->getIdCom();
            $produitsCommandes = $commande->getIdProduitCommande();
            $adresse = $commande->getIdAdresse();
            $produitsData = [];

            foreach ($produitsCommandes as $produitCommande) {
                $produit = $produitCommande->getIdProduit();
                $images = $produit->getImagesProduits();
                $imagesData = [];
                foreach ($images as $imageProduit) {
                    $imagesData[] = $imageProduit->getImage()->getNomImage();
                }
    
                $produitsData[] = [
                    'nom' => $produit->getNomProd(),
                    'prix' => $produit->getPrixProd(),
                    'quantite' => $produitCommande->getQuantite(),
                    'images' => $imagesData,
                ];
            }

            $commandesData[] = [
                'recapitulatif' => $commande->getRecapitulatif(),
                'commande_id' => $commande->getId(),
                'date' => $detailsCommande->first()->getDateCommande()->format('Y/m/d'),
                'statut' => $detailsCommande->first()->getStatut(),
                'prix_total' => $detailsCommande->first()->getPrixTot(),
                'adresse' => [
                    'rue' => $adresse->getLibelleVoie(),
                    'ville' => $adresse->getVille(),
                    'code_postal' => $adresse->getCodePostal(),
                ],
                'produits' => $produitsData,
            ];
        }
    
        // Rendre le template avec les données de la commande
        return $this->render('Mescommande.html.twig', [
            'commandes' => $commandesData,
            'dateMax' => $dateMax,
        ]);
    }


    #[Route('/supprimerCommande/{id}',name: 'suprimerCommande')]
    public function suprimerCommande($id, ManagerRegistry $doctrine,  SessionInterface $session): Response
    {
        $id = intval($id,10);
        $entityManager = $doctrine->getManager();
        $commande = $entityManager->getRepository(Commandes::class)->find($id);
        $detailsCommandes = $commande->getIdCom();
        $produitsCommandes = $commande->getIdProduitCommande();
        foreach($detailsCommandes as $detailsCommande){
        $entityManager->remove($detailsCommande);
        }
        foreach($produitsCommandes as $produitCommande){
            $stock = $produitCommande->getIdProduit()->getStock();
            $produitCommande->getIdProduit()->setStock($stock + 1);
        }
        $entityManager->getRepository(ProduitCommandes::class)->deleteByIdCommande($id);
        $entityManager->remove($commande);
        $entityManager->flush();

        if($session->get('user_role') == 'admin'){
        return $this->redirectToRoute('BOlisteCommande'); 
        }else{
        return $this->redirectToRoute('Mescommande');
        }
        
    }

}