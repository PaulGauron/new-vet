<?php

namespace App\Controller\BOController;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class BOmodifProduitController extends AbstractController
{

    #[Route('/BO/modifProduit', name: 'BO/modifProduit')]
    public function index(): Response
    {
        return $this->render('/BO/BOmodifProduit.html.twig');
    }
}
