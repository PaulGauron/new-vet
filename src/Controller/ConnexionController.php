<?php

namespace App\Controller;

use App\Form\ConnectionType;
use App\Form\ConnexionType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Attribute\Route;

class ConnexionController extends AbstractController
{
    //route
    #[Route('/connexion',name: 'connexion')]

    public function connexion()
    {

        $form = $this->createForm(ConnexionType::class);

        return $this->render('/connexion/connexionpage.html.twig',[
            'form' => $form->createView()
        ]);
    }
}

?>
