<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class ConnectionController
{

    //routes
    #[Route('/')]

    public function homepage(){

        return new Response('<strong>Starshop</strong>ll: your monopoly-busting option for Starship parts!');
    }

}

?>