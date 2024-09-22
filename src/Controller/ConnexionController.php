<?php

namespace App\Controller;

use App\Entity\Utilisateur;
use App\Form\ConnexionType;
use App\Repository\UtilisateurRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

class ConnexionController extends AbstractController
{
    //route
    #[Route('/connexion', name: 'connexion')]

    public function RequeteConnexion(Request $request, ManagerRegistry $doctorine, SessionInterface $session): Response
    {
        $entityManager = $doctorine->getManager();
        $form = $this->createForm(ConnexionType::class);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $email = $form->get('ConnectEmail')->getData();
            $mdp = $form->get('ConnectMdp')->getData();

            $utilisateurRepository = $entityManager->getRepository(Utilisateur::class);
            $utilisateur = $utilisateurRepository->findOneByEmail($email);

            if ($utilisateur && password_verify($mdp, $utilisateur->getMdp())) {
                // Si le mot de passe est correct, on stocke l'utilisateur dans la session
                $session->set('utilisateur', $utilisateur->getId());
                $session->set('user_role', $utilisateur->getDtype());
            } else {
                $this->addFlash('error', 'Email ou mot de passe incorrect.');
            }

            if ($session->get('user_role') == 'admin') {
                // Redirection vers la page d'accueil ou une autre page après connexion
                return $this->redirectToRoute('BO/ProductList');
            } else {
                // Redirection vers la page d'accueil ou une autre page après connexion
                return $this->redirectToRoute('accueil');
            }
        }

        return $this->render('/connexion/connexionpage.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    #[Route('/deconnexion', name: 'deconnexion')]
    public function deconnexion(SessionInterface $session): Response
    {
        // Déconnecte l'utilisateur
        $session->invalidate();

        return $this->redirectToRoute('connexion');
    }
}
