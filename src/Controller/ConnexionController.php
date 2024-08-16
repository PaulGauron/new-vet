<?php

namespace App\Controller;

use App\Form\ConnectionType;
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
    #[Route('/connexion',name: 'connexion')]

    public function RequeteConnexion(Request $request, ManagerRegistry $doctorine): Response
    {
        $entityManager = $doctorine->getManager();
        $form = $this->createForm(ConnexionType::class);
    
        $form->handleRequest($request);
        $test =' salut';
    
        if ($form->isSubmitted() && $form->isValid()) {
            $email = $form->get('email')->getData();
            $mdp = $form->get('mdp')->getData();
    
            // Récupérer le repository de l'utilisateur
            $utilisateurRepository = $entityManager->getRepository(UtilisateurRepository::class);
    
            // Chercher l'utilisateur par son email
            $utilisateur = $utilisateurRepository->findOneByEmail($email);
            $hash = password_hash($mdp,  PASSWORD_BCRYPT);

            $test = 'email :'.$email.' mdp : '.$mdp.' hash : '.$hash;
            return $this->render('example.html.twig', [
                'test' => $test,
            ]);
            
            if ($utilisateur) {
                // Récupérer le hash du mot de passe
                $password_hash = $utilisateur->getMdp();
    
                // Vérifier si le mot de passe est correct
                if (password_verify($mdp, $password_hash)) {
                    // Mot de passe correct
                   
                    //return $this->redirectToRoute('accueil');
                } else {
                    // Mot de passe incorrect
                    $this->addFlash(
                        'error', 
                        'Mot de passe incorrect.'
                    );
                }
            } else {
                // Utilisateur non trouvé
                $this->addFlash(
                    'error', 
                    'Utilisateur non trouvé.'
                );
            }
        }

        return $this->render('/connexion/connexionpage.html.twig',[
            'form' => $form->createView()
        ]);
    }
}

?>
