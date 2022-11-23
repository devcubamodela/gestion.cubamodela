<?php

namespace App\Controller;

use App\Entity\Products;
use PhpParser\Node\Expr\Empty_;
use Automattic\WooCommerce\Client;
use PhpParser\Node\Expr\ArrayItem;
use App\Repository\ProductsRepository;
use App\Controller\GlobalFuntionsController;
use Symfony\Component\HttpClient\HttpClient;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Automattic\WooCommerce\HttpClient\HttpClientException;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;


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

    public function auth()
    {

        $woocommerce = new Client(
            'https://testingtiendaonline.cubamodela.com/',
            'ck_f5610087fad2e45d2450d04a3e5a4d508697a6e2',
            'cs_1793afc267a0ac84e1d55cbc764b33bfadf209ea',
            [
                'wp_api' => true,
                'version' => 'wc/v3',
            ]
        );

        //var_dump($woocommerce->get('products'));die;

        $productos = $woocommerce->get('products', ['filter[limit]' => -1]);

        return $productos;
    }

    public function productsVariation($id)
    {

        $woocommerce = new Client(
            'https://testingtiendaonline.cubamodela.com/',
            'ck_f5610087fad2e45d2450d04a3e5a4d508697a6e2',
            'cs_1793afc267a0ac84e1d55cbc764b33bfadf209ea',
            [
                'wp_api' => true,
                'version' => 'wc/v3',

            ]
        );

        //var_dump($woocommerce->get('products'));die;


        $productos = $woocommerce->get('products/' . $id . '/variations');

        return $productos;
    }


    /**
     * @Route("/all", name= "allProducts")
     */
    public function AllProducts(): JsonResponse
    {
        $page = 1;
        $products = [];
        $all_products = [];
        $woocommerce = new Client(
            'https://testingtiendaonline.cubamodela.com/',
            'ck_f5610087fad2e45d2450d04a3e5a4d508697a6e2',
            'cs_1793afc267a0ac84e1d55cbc764b33bfadf209ea',
            [
                'wp_api' => true,
                'version' => 'wc/v3',

            ]
        );

        do {
            try {
                $products = $woocommerce->get('products', array('per_page' => 10, 'page' => $page));
            } catch (HttpClientException $e) {
                die("Can't get products: $e");
            }
            $all_products = array_merge($all_products, $products);
            $page++;
        } while (count($products) > 0);

        foreach ($all_products as $prod) {
            $id[] = [
                "id" => $prod->id,
                "sku" => $prod->sku,
                "name" => $prod->name,
                /* "stock_quantity"=>$prod->stock_quantity,
                "status"=>$prod->status,*/

            ];
            $productsVariations = $this->productsVariation($prod->id);
            foreach ($productsVariations as $prod1) {
                $var1[] = [
                    "id" => $prod1->id,
                    "sku" => $prod1->sku,

                ];
            }
            $id[] = $var1;
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
        foreach ($productos as $prod) {
            $id[] = [
                $sku = $prod->sku,
                $name = $prod->name,
                $picture = "",
                $amount = $prod->stock_quantity,
                $brand = $prod->slug,
                $date = $prod->date_created,

            ];
            $this->productsRepository->ProductRegister($name, $sku, $amount, $picture, $brand, $date);
        }
        return new JsonResponse($id);
    }
}
