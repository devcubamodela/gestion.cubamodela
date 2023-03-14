<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Automattic\WooCommerce\Client;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Validator\Constraints\Date;

class GlobalFuntionsController extends AbstractController
{

    /**

     * @Route("", name="route_principal")

     */
    public function index()
    {

        return $this->render('principal/principal.html.twig');
    }
    // /**

    //  * @Route("/time", name="route_principal")

    //  */
    // public function activarTrigger(): JsonResponse
    // {
    //     $hora = date('H:i:s');
    //     if($hora>='14:20:00'){
    //         return new JsonResponse("Super"); 
    //     }
    //     //Ejecutar tarea programada

       
    //     return new JsonResponse($hora);
    // }
}
