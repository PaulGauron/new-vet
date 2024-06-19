<?php

namespace App\Controller\BOController;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class BOlisteProduitController extends AbstractController
{

    #[Route('/listProduct', name: 'listProduct')]
    public function index(): Response
    {
        return $this->render('./BO/BOlisteProduit.html.twig');
    }
}
