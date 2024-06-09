<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class ConnectionController
{

    //route
    #[Route('/connexion')]

    public function homepage()
    {

        return new Response('<strong>Starshop</strong>: your monopoly-busting option for Starship parts!');
    }
}
