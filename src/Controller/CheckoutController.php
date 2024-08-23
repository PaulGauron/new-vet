<?php

namespace App\Controller;

use App\Entity\Adresse;
use App\Entity\AdresseClient;
use App\Entity\Client;
use App\Entity\Utilisateur;

use App\Form\AdresseType;
use App\Form\PaiementType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CheckoutController extends AbstractController
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    // #[Route('/checkout', name: 'checkout')]
    // public function checkout(Request $request): Response
    // {
    //     $adresse = new Adresse();
    //     $adresseForm = $this->createForm(AdresseType::class, $adresse);
    
    //     $adresseForm->handleRequest($request);
    //     if ($adresseForm->isSubmitted() && $adresseForm->isValid()) {
            
    //         $utilisateur = $this->getUser(); // Assurez-vous que c'est un Client
    //         if (!$utilisateur instanceof Utilisateur) {
    //             throw new \Exception('Utilisateur non valide pour ce type d\'opération.');
    //         }
    //         $userId = $utilisateur->getId();
    
    //         $adresseClient = new AdresseClient();
    //         $adresseClient->setIdUtilisateur($utilisateur);
    //         $adresseClient->setIdAdresse($adresse);
    
    //         $this->entityManager->persist($adresseClient);
    //         $this->entityManager->flush();
    
    //         return $this->redirectToRoute('checkout_payment');
    //     }
    
    //     return $this->render('checkoutInfosClient.html.twig', [
    //         'adresseForm' => $adresseForm->createView(),
    //     ]);
    // }

    #[Route('/checkout', name: 'checkout')]
public function checkout(Request $request): Response
{
    $adresse = new Adresse();
    $adresseForm = $this->createForm(AdresseType::class, $adresse);
    
    $adresseForm->handleRequest($request);

    if ($adresseForm->isSubmitted() && $adresseForm->isValid()) {
        $utilisateur = $this->getUser();
        
        // Ajoutez cette ligne pour vérifier le type de l'utilisateur
        dump($utilisateur); // Utilisez dump() pour afficher l'objet utilisateur et son type
        
        // Assurez-vous que l'utilisateur est une instance de Client
        // if (!$utilisateur instanceof Client) {
        //     throw new \Exception('Utilisateur non valide pour ce type d\'opération. Utilisateur: ' . get_class($utilisateur));
        // }

        // $userId = $utilisateur->getId();
        

        // $adresseClient = new AdresseClient();
        // $adresseClient->setIdUtilisateur($utilisateur);
        // $adresseClient->setIdAdresse($adresse);
    
        // $this->entityManager->persist($adresseClient);
        // $this->entityManager->flush();
    
        return $this->redirectToRoute('paiement');
    }
    
    return $this->render('checkoutInfosClient.html.twig', [
        'adresseForm' => $adresseForm->createView(),
    ]);
}

#[Route('/paiement', name: 'paiement')]
public function payment(Request $request): Response
{
    $paymentForm = $this->createForm(PaiementType::class);

    $paymentForm->handleRequest($request);
    if ($paymentForm->isSubmitted() && $paymentForm->isValid()) {
        // Traitement du paiement effectué à l'aide d'API paypal, CB ...

        // Rediriger vers la page de confirmation de commande
        return $this->redirectToRoute('checkout_confirmation');
    }

    return $this->render('paiement.html.twig', [
        'paymentForm' => $paymentForm->createView(),
    ]);
}

    #[Route('/checkout/confirmation', name: 'checkout_confirmation')]
    public function confirmation(): Response
    {
        return $this->render('checkout/confirmation.html.twig');
    }
}
