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


    #[Route('/checkout', name: 'checkout')]
    public function checkout(Request $request): Response
    {
        $client = new Client();

        $adresse = new Adresse();
        $adresseForm = $this->createForm(AdresseType::class, $adresse);
        $adresseForm->handleRequest($request);

        // $session = $request->getSession();
        // $session->set('user_id', $client->getId());
        // $userId = $session->get('user_id');

        if ($adresseForm->isSubmitted() && $adresseForm->isValid()) {

            if (!$client instanceof Client) {
                throw new \Exception('Utilisateur n\'est pas un Client.');
            }

            // Persister l'adresse si elle est nouvelle
            if ($this->entityManager->getUnitOfWork()->isScheduledForInsert($adresse)) {
                $this->entityManager->persist($adresse);
            }

            $adresseClient = new AdresseClient();
            $adresseClient->setIdUtilisateur($client);
            $adresseClient->setIdAdresse($adresse);

            $this->entityManager->persist($adresseClient);
            $this->entityManager->flush();

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
