<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class BOmodifProduit extends AbstractController
{

    #[Route('/updateProduct', name: 'updateProduct')]
    public function index(): Response
    {
        return $this->render('/BOmodifProduit.html.twig');
    }
}
