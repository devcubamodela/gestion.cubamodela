<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Automattic\WooCommerce\Client;
use Symfony\Component\HttpFoundation\JsonResponse;

     /**
     * @Route("/api")
     */
class GlobalFuntionsController extends AbstractController
{
    
    /**
     * @Route("/")
     */
    public function index()
    {
        $productos = [];

        require __DIR__ . '/../../vendor/autoload.php';


        $woocommerce = new Client(
            'https://testingtiendaonline.cubamodela.com/',
            'ck_0398b67e840129713998e7b1f5335bf7540bdc14',
            'cs_f798e57bd3a2e4c51658cacc55a2da776d6a5c99',
            [
                'wp_api'=> true,
                'version' => 'wc/v3',
            ]
        );
        //var_dump($woocommerce->get('products'));die;
       
        $productos= $woocommerce->get('products');

        foreach($productos as $prod){
            $id[]= [
                "id"=>$prod->id,
                "name"=>$prod->name,
                "slug"=>$prod->slug,
                "permalink"=>$prod->permalink,
                "date_created"=>$prod->date_created,
            ];
            }
       
      

        return $productos;
        

       
    }
}


