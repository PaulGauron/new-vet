<?php

namespace App\Controller\BOController;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class BOajouterProduitController extends AbstractController
{

    #[Route('/addProduct', name: 'addProduct')]
    public function index(): Response
    {
        return $this->render('./BO/BOajouterProduit.html.twig');
    }
}