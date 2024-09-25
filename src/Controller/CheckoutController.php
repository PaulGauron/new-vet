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
use PHPUnit\TextUI\Command;

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
        $adresseClient = $this->entityManager->getRepository(Adresse::class)->findAdresseByUserID($userId);


        if (!$client) {
            // If no existing Client

        }

        $form = $this->createForm(
            MainCheckoutType::class,
            [
                'adresseClient' => $adresseClient,
                'adresse' => $adresse,
                'client' => $client
            ]
        );

        $form->handleRequest($request);


        if ($form->isSubmitted() && $form->isValid()) {
            $data = $form->getData();
            $client = $data['client'];
            $idAdresseExistante = $form->get('adresse')->get('id_adresse')->getData();


            if ($idAdresseExistante) {
                $adresse = $this->entityManager->getRepository(Adresse::class)->find($idAdresseExistante);
            } else {
                // Sinon, utiliser les données du formulaire pour créer une nouvelle adresse
                $adresse = $data['adresse'];
                $this->entityManager->persist($adresse);
            }
            $session->set('adresse', $adresse);

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
        $adresse = $session->get('adresse');
        // dd($adresse);
        $clientInfos = $this->entityManager->getRepository(Client::class)->find($userId);

        $produits = [];
        $prixProds = [];
        $paniers = $session->get('panier', []);
        foreach ($paniers as $key => $panier) {
            $infos = $this->entityManager->getRepository(Produit::class)->findInfosProduitById($key);
            $quantite = $panier;
            $tot = +$quantite * $infos[0]['prix_prod'];
            array_push($infos, $quantite);
            array_push($produits, $infos);
            array_push($prixProds, $tot);
        }

        $total = array_sum($prixProds);


        return $this->render('paiement.html.twig', [
            'produits' => $produits,
            'clients' => $clientInfos,
            'adresse' => $adresse,
            'total' => $total,
        ]);
    }

    #[Route('/ajouterCommande', name: 'ajouterCommande')]
    public function ajouterCommande(Request $request, SessionInterface $session, ManagerRegistry $doctorine)
    {
        $entityManager = $doctorine->getManager();
        $prix_tot = $request->request->get('prix_tot');
        $id_adresse = $session->get('adresse')->getId();
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
        $detail_commande->setStatut('traitement');
        $entityManager->persist($commande);
        $entityManager->persist($detail_commande);
        $recap = "Récapitulatif de la commande :\n";

        // Ajout des informations utilisateur
        $recap .= "Client : " . $user->getNom() . " " . $user->getPrenom() . "\n";

        // Ajout des informations sur la commande et le prix total
        $recap .= "Date de la commande : " . $date->format('Y-m-d') . "\n";
        $recap .= "Prix total : " . $prix_tot . " €\n";

        // Ajout des informations de l'adresse
        $recap .= "Adresse de livraison : " . $adresse->getLibelleVoie() . ", " . $adresse->getVille() . ", code postal : " . $adresse->getCodePostal() . "\n";

        foreach ($paniers as $key => $panier) {
            $produit = $this->entityManager->getRepository(Produit::class)->find($key);
            $stock = $produit->getStock();
            $produit->setStock($stock - $panier);
            $produitCommande = new ProduitCommandes();
            $produitCommande->setCommande($commande);
            $produitCommande->setIdProduit($produit);
            $entityManager->persist($produitCommande);
            $produitCommande->setQuantite($panier);

            // Ajout des informations de chaque produit au récapitulatif
            $recap .= "Produit : " . $produit->getNomProd() . "\n";
            $recap .= "Quantité : " . $panier . "\n";
        }


        $commande->setRecapitulatif($recap);
        $entityManager->flush();
        $session->remove('panier');
        $session->remove('adresse');
        // Redirection ou autre traitement une fois la commande créée
        return $this->redirectToRoute('Mescommande');
    }

    #[Route('/anulationCommande', name: 'anulationCommande')]
    public function anulationCommande(SessionInterface $session)
    {
        $session->remove('panier');
        $session->remove('adresse');
        return $this->redirectToRoute('accueil');
    }
}
