<?php

namespace App\Controller;

use App\Entity\Adresse;
use App\Entity\AdresseClient;
use App\Entity\Client;
use App\Entity\Commandes;
use App\Entity\DetailCommande;
use App\Entity\Produit;
use App\Entity\ProduitCommandes;
use App\Entity\Utilisateur;


use App\Form\MainCheckoutType;
use DateTime;
use DateTimeInterface;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Doctrine\Persistence\ManagerRegistry;

class CheckoutController extends AbstractController
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }


    #[Route('/checkout', name: 'checkout')]
    public function checkout(Request $request, EntityManagerInterface $entityManager): Response
    {

        $adresse = new Adresse();

        $session = $request->getSession();
        $userId = $session->get('utilisateur');

        $utilisateur = $this->entityManager->getRepository(Utilisateur::class)->find($userId);

        if (!$utilisateur) {
            throw $this->createNotFoundException('Utilisateur not found');
        }

        //Search Client if it exists
        $client = $this->entityManager->getRepository(Client::class)->find($userId);

        if (!$client) {
            // If no existing Client, create a new Client instance
            $client = new Client();
            $client->setId($userId);  
        }

        $form = $this->createForm(
            MainCheckoutType::class,
            [
                'adresse' => $adresse,
                'client' => $client
            ]
        );

        $form->handleRequest($request);

      
        if ($form->isSubmitted() && $form->isValid()) {
            $data = $form->getData();
            $client = $data['client'];
            $adresse = $data['adresse'];
    
            // Update Client with data from the form
            $client->setNom($utilisateur->getNom());
            $client->setPrenom($utilisateur->getPrenom());
            $client->setEmail($utilisateur->getEmail());
            $client->setMdp($utilisateur->getMdp()); 
    
            // Update client details
            $client->setCVV($data['client']->getCVV());
            $client->setDateExpirationCarte($data['client']->getDateExpirationCarte());
            $client->setMethodePaiement($data['client']->getMethodePaiement());
            $client->setNomCarte($data['client']->getNomCarte());
            $client->setNumeroCarte($data['client']->getNumeroCarte());
    
            // Persist the address if it's new
            if ($entityManager->getUnitOfWork()->isScheduledForInsert($adresse)) {
                $entityManager->persist($adresse);
            }
    
            // Persist or update the Client entity
            $entityManager->persist($client);
    
            // Manage AdresseClient association
            $adresseClient = $entityManager->getRepository(AdresseClient::class)
                ->findOneBy(['id_utilisateur' => $client, 'id_adresse' => $adresse]);
    
            if (!$adresseClient) {
                $adresseClient = new AdresseClient();
                $adresseClient->setIdUtilisateur($client);
                $adresseClient->setIdAdresse($adresse);
                $entityManager->persist($adresseClient);
            }
    
            $entityManager->flush();
    
            return $this->redirectToRoute('paiement');
        }
    

        return $this->render('checkoutInfosClient.html.twig', [
            'form' => $form->createView(),
        ]);
    }


    #[Route('/paiement', name: 'paiement')]
    public function payment(Request $request)
    {
        $session = $request->getSession();
        $userId = $session->get('utilisateur');
        $clientInfos = $this->entityManager->getRepository(Client::class)->findInfosClientById($userId);
        
        $produits = [];
        $prixProds= [];
        $paniers = $session->get('panier', []);
        foreach($paniers as $key => $panier){
            $infos = $this->entityManager->getRepository(Produit::class)->findInfosProduitById($key);
            $quantite = $panier;
            $tot =+ $quantite * $infos[0]['prix_prod'];
            array_push($infos,$quantite);
            array_push($produits,$infos);
            array_push($prixProds, $tot);
        }
         
        $total = array_sum($prixProds);
              

        return $this->render('paiement.html.twig',[
            'produits' => $produits,
            'clients' => $clientInfos,
            'total' => $total,
        ]);

        
    }

    #[Route('/ajouterCommande', name: 'ajouterCommande')]
    public function ajouterCommande(Request $request, SessionInterface $session, ManagerRegistry $doctorine)
    {
        $entityManager = $doctorine->getManager();
        $prix_tot = $request->request->get('prix_tot');
        $id_adresse = $request->request->get('id_adresse');
        $userId = $session->get('utilisateur');
      
        $user = $this->entityManager->getRepository(Client::class)->find($userId);
        $adresse = $this->entityManager->getRepository(Adresse::class)->find($id_adresse);
        $paniers = $session->get('panier', []);
        $date = new \DateTime(); // Récupère la date et l'heure actuelles
        $commande = new Commandes();
        $commande->setIdUtil($user);
        $commande->setIdAdresse($adresse);
        $detail_commande = new DetailCommande();
        $detail_commande->setPrixTot($prix_tot);
        $detail_commande->setDateCommande($date);
        $detail_commande->setIdCom($commande);
        $entityManager->persist($commande);
        $entityManager->persist($detail_commande);
        $entityManager->flush();
        foreach($paniers as $key => $panier){
            $produit = $this->entityManager->getRepository(Produit::class)->find($key);
            $produitCommande = new ProduitCommandes();
            $produitCommande->setIdCommande($commande);
            $produitCommande->setIdProduit($produit);
            $entityManager->persist($produitCommande);
            $produitCommande->setQuantite($panier);
        }

        $entityManager->flush();
        $session->remove('panier');
       
        // Redirection ou autre traitement une fois la commande créée
        return $this->render('Mescommande.html.twig');
    }

    #[Route('/anulationCommande', name: 'anulationCommande')]
    public function anulationCommande(Request $request,  SessionInterface $session)
    {
        $session->remove('panier');
        return $this->render('accueil.html.twig');
    }


}
