<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Automattic\WooCommerce\Client;
use Symfony\Component\HttpFoundation\JsonResponse;

    
class GlobalFuntionsController extends AbstractController
{
    

    public function __construct()
    {
 
    }
   
    public function index()
    {
        
        require __DIR__ . '/../../vendor/autoload.php';
        $woocommerce = new Client(
            'https://testingtiendaonline.cubamodela.com/',
            'ck_fc6c722bd737554ba6236d96458a2e1d306174e2',
            'cs_a430cf1115c986e0436d5e8e8f43fc393a9770bb',
            [
                'wp_api' => true,
                'version' => 'wc/v3',
                'timeout' => 120,

            ]
        );
        return $woocommerce;
    }
}


