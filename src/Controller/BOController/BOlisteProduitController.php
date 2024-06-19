<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class BOlisteProduit extends AbstractController
{

    #[Route('/listProduct', name: 'listProduct')]
    public function index(): Response
    {
        return $this->render('/BOlisteProduit.html.twig');
    }
}
