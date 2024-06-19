<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class BOtableauBord extends AbstractController
{

    #[Route('/Dashbord', name: 'Dashbord')]
    public function index(): Response
    {
        return $this->render('/BOtableauBord.html.twig');
    }
}
