<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/almacen")
 */
class AlmacenController extends AbstractController
{

/**
 * @Route("/show")
 */
    public function index(): Response
    {
        return $this->render('almacen/index.html.twig', [
            'controller_name' => 'AlmacenController',
        ]);
    }
}