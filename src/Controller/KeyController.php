<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Automattic\WooCommerce\Client;
use Symfony\Component\HttpFoundation\JsonResponse;

class KeyController extends AbstractController
{
    public function index()
    {
        
        require __DIR__ . '/../../vendor/autoload.php';
        $woocommerce = new Client(
            'https://testingtiendaonline.cubamodela.com/',
            'ck_51ebd65ac994a7342732ab406e365eba6bc11ebf',
            'cs_376c2bce38390405f53ca9b989ac9b806d6abced',
            [
                'wp_api' => true,
                'version' => 'wc/v3',
                'timeout' => 200,

            ]
        );
        return $woocommerce;
    }
    public function keyV2(){
        $woocommerce = new Client(
            'https://testingtiendaonline.cubamodela.com/',
            'ck_51ebd65ac994a7342732ab406e365eba6bc11ebf',
            'cs_376c2bce38390405f53ca9b989ac9b806d6abced',
            [
                'wp_api' => true,
                'version' => 'wp/v2',
                'timeout' => 200,
    
            ]
        );

      return $woocommerce;
    }
   
}
