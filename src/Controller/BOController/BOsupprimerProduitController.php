<?php

namespace App\Controller\BOController;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class BOsupprimerProduitController extends AbstractController
{

    #[Route('/deleteProduct', name: 'deleteProduct')]
    public function index(): Response
    {
        return $this->render('./BO/BOsupprimerProduit.html.twig');
    }
}
