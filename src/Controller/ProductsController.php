<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Controller\GlobalFuntionsController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Automattic\WooCommerce\Client;
use App\Entity\Products;
use App\Repository\ProductsRepository;

use Symfony\Component\HttpClient\HttpClient;


/**
 * @Route("/products")
 */

class ProductsController extends AbstractController
{
private $productsRepository;

    public function __construct(ProductsRepository $productsRepository)
    {
        $this->productsRepository = $productsRepository;
       
    }
      /**
 * @Route("/all", name= "all_Products")
 */
    public function auth(){
        
        $woocommerce = new Client(
            'https://testingtiendaonline.cubamodela.com/',
            'ck_f5610087fad2e45d2450d04a3e5a4d508697a6e2',
            'cs_1793afc267a0ac84e1d55cbc764b33bfadf209ea',
            [
                'wp_api'=> true,
                'version' => 'wc/v3',
                
            ]
        );
       
        //var_dump($woocommerce->get('products'));die;
      
        $productos= $woocommerce->get('products');

        return $productos;
    }

    public function productsVariation($id){

        $woocommerce = new Client(
            'https://testingtiendaonline.cubamodela.com/',
            'ck_f5610087fad2e45d2450d04a3e5a4d508697a6e2',
            'cs_1793afc267a0ac84e1d55cbc764b33bfadf209ea',
            [
                'wp_api'=> true,
                'version' => 'wc/v3',
                
            ]
        );
       
        //var_dump($woocommerce->get('products'));die;
       
        $productos= $woocommerce->get('products/'.$id.'/variations');
        
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
                "id"=>$prod->id,
                "sku"=>$prod->sku,
                "name"=>$prod->name,
               /* "stock_quantity"=>$prod->stock_quantity,
                "status"=>$prod->status,*/
               
           ];
           $id[] = $this->productsVariation($prod->id);
           
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
            $sku=$prod->sku,
            $name=$prod->name,
            $picture="",
            $amount=$prod->stock_quantity,
            $brand=$prod->slug,
            $date=$prod->date_created,
           
        ];
        $this->productsRepository->ProductRegister($name,$sku, $amount ,$picture, $brand, $date);
           
        }
return new JsonResponse($id);

}
}
