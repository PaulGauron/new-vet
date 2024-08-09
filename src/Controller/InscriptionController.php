<?php

namespace App\Controller;

use App\Entity\Utilisateur;
use App\Form\UtilisateurType;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class InscriptionController extends AbstractController
{
    //route
    #[Route('/inscription')]

    public function RequeteInscription(ManagerRegistry $doctorine): Response
    {
        $entityManager = $doctorine->getManager();
        $user = new Utilisateur();
        $form = $this->createForm(UtilisateurType::class, $user);

        return $this->render('/inscription/inscriptionpage.html.twig', [
        'form' => $form->createView()
    ]);
    
    }

    
}