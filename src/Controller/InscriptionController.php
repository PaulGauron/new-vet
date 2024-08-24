<?php

namespace App\Controller;

use App\Entity\Client;
use App\Entity\Utilisateur;
use App\Form\UtilisateurType;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;
use phpDocumentor\Reflection\Types\Boolean;
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
        function passwordCheck($mdp): bool
        {
            $nbPoints = 10;
            $nbChar = strlen($mdp);
            $pointsNbChar = 0;
            $pointsComplex = 0;

            if ($nbChar >= 8) {
                $pointsNbChar = 1;
            }

            if (preg_match("/[a-z]/", $mdp)) {
                $pointsComplex += 1;
            }

            if (preg_match("/[A-Z]/", $mdp)) {
                $pointsComplex += 2;
            }

            if (preg_match("/[0-9]/", $mdp)) {
                $pointsComplex += 3;
            }

            if (preg_match("/\W/", $mdp)) {
                $pointsComplex += 4;
            }

            $res = $pointsNbChar * $pointsComplex;

            return ($nbPoints == $res);
        }

        $entityManager = $doctorine->getManager();
        $user = new Client();
        $form = $this->createForm(UtilisateurType::class, $user);

        $form->handleRequest($request);
        $user = $form->getData();

        if ($form->isSubmitted() && $form->isValid()) {
        $password = $form->get('mdp')->getData();
        $passwordConfirmation = $form->get('mdp_comfirmation')->getData();

        
        if ($password !== $passwordConfirmation) {
            $this->addFlash('errorConfirmMdp', 'Le mot de passe et la cofirmation de mot de passe ne correspondent pas.');
            return $this->render('/inscription/inscriptionpage.html.twig', [
                'form' => $form->createView(),
            ]);
        }

        if(passwordCheck($password)){
            $user->setMdp(password_hash($user->getMdp(), PASSWORD_BCRYPT));
            $entityManager->persist($user);
    
            // Exécuter l'instruction SQL (INSERT) pour sauvegarder les données
            $entityManager->flush();
    
            $test = $user->getMdp();
            // Rediriger vers la page de connexion
            return $this->redirectToRoute('connexion'); 
        }else{
            $this->addFlash('errorMdp', 'Le mot de passe n\'est pas assez fort.\n il doit contenir au moins 8 charactères, une minuscule, une majuscule,un nombre et un charactère spéciale.');
            return $this->render('/inscription/inscriptionpage.html.twig', [
                'form' => $form->createView(),
            ]);
        }
       
        }
        
        return $this->render('/inscription/inscriptionpage.html.twig', [
            'form' => $form->createView(),
        ]);

       
    }
}
