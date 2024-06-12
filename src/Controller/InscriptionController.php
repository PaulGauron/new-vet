<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Attribute\Route;

class InscriptionController extends AbstractController
{
    //route
    #[Route('/inscription')]

    public function connexion()
    {

        return $this->render('/inscription/inscriptionpage.html.twig');
    }
}