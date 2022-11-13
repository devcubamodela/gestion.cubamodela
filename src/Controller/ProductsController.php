<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Controller\GlobalFuntionsController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Automattic\WooCommerce\Client;


use Symfony\Component\HttpClient\HttpClient;


/**
 * @Route("/products")
 */

class ProductsController extends AbstractController
{

    public function auth(){
        $productos = [];
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

        return $productos;
    }


    /**
 * @Route("/all", name= "all_Products")
 */
    public function all_Products(): JsonResponse
    {
        require __DIR__ . '/../../vendor/autoload.php';
           $productos = $this->auth();
           foreach($productos as $prod){
            $id[]= [
                "sku"=>$prod->sku,
                "name"=>$prod->name,
                "stock_quantity"=>$prod->stock_quantity,
                "status"=>$prod->status,
               
            ];
            }
return new JsonResponse($id);

    }

     /**
 * @Route("/push_products", name= "push_products")
 */
public function push_products(): JsonResponse
{
    require __DIR__ . '/../../vendor/autoload.php';
       $productos = $this->auth();
       foreach($productos as $prod){
        $id[]= [
            "sku"=>$prod->sku,
            "name"=>$prod->name,
            "images"=>$prod->images,
            "brand"=>$prod->slug,
            "date_created"=>$prod->date_created,
           
        ];
        }
return new JsonResponse($id);

}
}
