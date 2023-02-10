<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Automattic\WooCommerce\Client;
use Symfony\Component\HttpFoundation\JsonResponse;

    

   

class GlobalFuntionsController extends AbstractController
{
    
       /**

    * @Route("", name="route_principal")

    */
    public function index()
    {
      
        return $this->render('principal/principal.html.twig');
    }
}


