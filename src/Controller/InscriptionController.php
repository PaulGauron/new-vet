<?php

namespace App\Controller;

use App\Entity\Utilisateur;
use App\Form\UtilisateurType;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class InscriptionController extends AbstractController
{
    //route
    #[Route('/inscription', name: 'inscription')]

    public function RequeteInscription(Request $request, ManagerRegistry $doctorine): Response
    {
        $entityManager = $doctorine->getManager();
        $user = new Utilisateur();
        $form = $this->createForm(UtilisateurType::class, $user);
        
        $form->handleRequest($request);
        $user = $form->getData();

        $password = $form->get('mdp')->getData();
        $passwordConfirmation = $form->get('mdp_comfirmation')->getData();
    
        if ($password !== $passwordConfirmation) {
            $this->addFlash('error', 'Les mots de passe ne correspondent pas.');
            return $this->render('/inscription/inscriptionpage.html.twig', [
                'form' => $form->createView(),
            ]);
        }

        $user->setMdp(password_hash($user->getMdp(), PASSWORD_BCRYPT));

        // Persister l'entité utilisateur
        $entityManager->persist($user);

        // Exécuter l'instruction SQL (INSERT) pour sauvegarder les données
        $entityManager->flush();
            
            // Rediriger ou afficher un message de succès
          //  return $this->redirectToRoute('connexion'); // Remplacez 'home_page' par la route de votre page d'accueil ou autre page de destination
    
        return $this->render('/inscription/inscriptionpage.html.twig', [
        'form' => $form->createView()
        ]);
    
    }

    
}