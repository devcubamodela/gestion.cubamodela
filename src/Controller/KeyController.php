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
            'ck_9165c363f548a688c68e2c6fa3fd6ecddcf80c99',
            'cs_fc6cf6161c04ef01684a8e4ba41200e94bdef29a',
            [
                'wp_api' => true,
                'version' => 'wc/v3',
                'timeout' => 120,

            ]
        );
        return $woocommerce;
    }
}
