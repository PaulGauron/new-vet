<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Attribute\Route;

class ConnectionController extends AbstractController
{
    //route
    #[Route('/connexion')]

    public function connexion()
    {

        return $this->render('/connexion/connexionpage.html.twig');
    }
}

?>
