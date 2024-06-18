<?php
// src/Controller/MenuController.php
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CategorieController extends AbstractController
{
    //route
    #[Route('/categorie', name: 'categorie')]
    public function categorie(): Response
    {
        return $this->render('categorie.html.twig');
    }
}
