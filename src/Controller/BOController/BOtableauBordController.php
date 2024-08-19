<?php

namespace App\Controller\BOController;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class BOtableauBordController extends AbstractController
{

    #[Route('/dashbord', name: 'dashbord')]
    public function dashbord(): Response
    {
        return $this->render('/BO/BOtableauBord.html.twig');
    }
}
