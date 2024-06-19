<?php

namespace App\Controller\BOController;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class BOmodifProduitController extends AbstractController
{

    #[Route('/updateProduct', name: 'updateProduct')]
    public function index(): Response
    {
        return $this->render('./BO/BOmodifProduit.html.twig');
    }
}
