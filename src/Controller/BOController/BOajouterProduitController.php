<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class BOajouterProduit extends AbstractController
{

    #[Route('/addProduct', name: 'addProduct')]
    public function index(): Response
    {
        return $this->render('/BOajouterProduit.html.twig');
    }
}
