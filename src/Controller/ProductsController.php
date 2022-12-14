<?php

namespace App\Controller;

use App\Entity\Products;
use PhpParser\Node\Expr\Empty_;
use Automattic\WooCommerce\Client;
use PhpParser\Node\Expr\ArrayItem;
use App\Repository\ProductsRepository;
use App\Controller\GlobalFuntionsController;
use Symfony\Component\HttpClient\HttpClient;
use Symfony\Component\HttpFoundation\Request;
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

        $productos = $woocommerce->get('products');

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
                'timeout' => 120,

            ]
        );


        do {
            try {
                $products = $woocommerce->get('products', array('per_page' => 50, 'page' => $page));
            } catch (HttpClientException $e) {
                die("Can't get products: $e");
            }
            $all_products = array_merge($all_products, $products);
            $page++;
        } while (count($products) > 0);
        foreach ($all_products as $prod) {
            $data[] = [
                "id" => $prod->id,
                "name" => $prod->name,
                "sku" => $prod->sku,
                "date_created" => $prod->date_created,
                "slug" => $prod->slug,
                "date_modified_gmt" => $prod->date_modified_gmt,
                "date_created_gmt" => $prod->date_created_gmt,
                "date_modified" => $prod->date_modified,
                "date_modified_gmt" => $prod->date_modified_gmt,
                "type" => $prod->type,
                "status" => $prod->status,
                "featured" => $prod->featured,
                "catalog_visibility" => $prod->catalog_visibility,
                "description" => $prod->description,
                "short_description" => $prod->short_description,
                "price" => $prod->price,

                "regular_price" => $prod->regular_price,
                "date_on_sale_from" => $prod->date_on_sale_from,
                "date_on_sale_from_gmt" => $prod->date_on_sale_from_gmt,
                "date_on_sale_to" => $prod->date_on_sale_to,
                "date_on_sale_to_gmt" => $prod->date_on_sale_to_gmt,
                "on_sale" => $prod->on_sale,
                "total_sales" => $prod->total_sales,
                "stock_quantity" => $prod->stock_quantity,
                "stock_status" => $prod->stock_status,

                "backorders" => $prod->backorders,
                "backorders_allowed" => $prod->backorders_allowed,

            ];
        }



        return new JsonResponse($data);
    }


    /**
     * @Route("/updateProduct", name= "UpdateProduct", methods="PUT")
     */
    public function UpdateProduct(Request $request): JsonResponse
    {
        require __DIR__ . '/../../vendor/autoload.php';
        if (!empty($_GET['id'])) {
            return new JsonResponse("Por Favor introduzca un Id");
        }
        $in = json_decode($request->getContent(), true);
        $id = $in["id"];

        $woocommerce = new Client(
            'https://testingtiendaonline.cubamodela.com/',
            'ck_f5610087fad2e45d2450d04a3e5a4d508697a6e2',
            'cs_1793afc267a0ac84e1d55cbc764b33bfadf209ea',
            [
                'wp_api' => true,
                'version' => 'wc/v3',

            ]
        );


        try {
            $woocommerce->put('products/' . $id, json_decode($request->getContent(), true));
            $product = $woocommerce->get('products/' . $id);
            $id = [
                "sku" => $product->sku,
                "name" => $product->name,
                "amount" => $product->stock_quantity,
                "slug" => $product->slug,
                "date" => $product->date_created,

            ];
        } catch (HttpClientException $e) {
            die("Can't get products: $e");
        }
        return new JsonResponse("Producto actualizado");
    }

    /**
     * @Route("/save", name= "Save", methods="GET")
     */
    public function push_products(): JsonResponse
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
                'timeout' => 120,

            ]
        );


        do {
            try {
                $products = $woocommerce->get('products', array('per_page' => 50, 'page' => $page));
            } catch (HttpClientException $e) {
                die("Can't get products: $e");
            }
            $all_products = array_merge($all_products, $products);
            $page++;
        } while (count($products) > 0);
        foreach ($all_products as $prod) {
            $product = $this->productsRepository->findOneBy(["idProduct" => $prod->id]);
            if (!$product) {
                $id = $prod->id;
                $name = $prod->name;
                $sku = $prod->sku;
                $date_created = $prod->date_created;
                $slug = $prod->slug;
                $date_modified_gmt = $prod->date_modified_gmt;
                $date_created_gmt = $prod->date_created_gmt;
                $date_modified = $prod->date_modified;
                $date_modified_gmt = $prod->date_modified_gmt;
                $type = $prod->type;
                $status = $prod->status;
                $featured = $prod->featured;
                $catalog_visibility = $prod->catalog_visibility;
                $description = $prod->description;
                $short_description = $prod->short_description;
                $price = $prod->price;
                $regular_price = $prod->regular_price;
                $date_on_sale_from = $prod->date_on_sale_from;
                $date_on_sale_from_gmt = $prod->date_on_sale_from_gmt;
                $date_on_sale_to = $prod->date_on_sale_to;
                $date_on_sale_to_gmt = $prod->date_on_sale_to_gmt;
                $on_sale = $prod->on_sale;
                $total_sales = $prod->total_sales;
                $stock_quantity = $prod->stock_quantity;
                $stock_status = $prod->stock_status;
                $backorders = $prod->backorders;
                $backorders_allowed = $prod->backorders_allowed;

                $this->productsRepository->ProductRegister(
                    $id,
                    $name,
                    $sku,
                    $date_created,
                    $slug,
                    $date_modified_gmt,
                    $date_created_gmt,
                    $date_modified,
                    $date_modified_gmt,
                    $type,
                    $status,
                    $featured,
                    $catalog_visibility,
                    $description,
                    $short_description,
                    $price,
                    $regular_price,
                    $date_on_sale_from,
                    $date_on_sale_from_gmt,
                    $date_on_sale_to,
                    $date_on_sale_to_gmt,
                    $on_sale,
                    $total_sales,
                    $stock_quantity,
                    $stock_status,
                    $backorders,
                    $backorders_allowed
                );
            }
        }
        return new JsonResponse("Products Saved");
    }

    /**
     * @Route("/filter", name= "Filter Product", methods="GET")
     */
    public function filterProducts(Request $request): JsonResponse
    {
        if (empty($_GET['idProduct']) && empty($_GET['name']) && empty($_GET['sku'])) {
            $products = $this->productsRepository->findAll();
            foreach ($products as $prod) {
                $data[] = [
                    "id" => $prod->getIdProduct(),
                    "name" => $prod->getName(),
                    "sku" => $prod->getSku(),
                    "date_created" => $prod->getDateCreated(),
                    "slug" => $prod->getSlug(),
                    "date_modified_gmt" => $prod->getDateModifiedGmt(),
                    "date_created_gmt" => $prod->getDateCreatedGmt(),
                    "date_modified" => $prod->getDateModified(),
                    "date_modified_gmt" => $prod->getDateModifiedGmt(),
                    "type" => $prod->getType(),
                    "status" => $prod->getStatus(),
                    "featured" => $prod->getFeatured(),
                    "catalog_visibility" => $prod->getCatalogVisibility(),
                    "description" => $prod->getDescription(),
                    "short_description" => $prod->getShortDescription(),
                    "price" => $prod->getPrice(),

                    "regular_price" => $prod->getRegularPrice(),
                    "date_on_sale_from" => $prod->getDateOnSaleFrom(),
                    "date_on_sale_from_gmt" => $prod->getDateOnSaleFromGmt(),
                    "date_on_sale_to" => $prod->getDateOnSaleTo(),
                    "date_on_sale_to_gmt" => $prod->getDateOnSaleToGmt(),
                    "on_sale" => $prod->getOnSale(),
                    "total_sales" => $prod->getTotalSales(),
                    "stock_quantity" => $prod->getStockQuantity(),
                    "stock_status" => $prod->getStockStatus(),
                    "backorders" => $prod->getBackorders(),
                    "backorders_allowed" => $prod->getBackordersAllowed(),

                ];
            }
            return new JsonResponse($data);
        }

        $var = array();


        if (!empty($_GET['idProduct'])) {
            $var['idProduct'] = $request->query->get('idProduct');
        }
        if (!empty($_GET['name'])) {
            $var['name'] = $request->query->get('name');
        }
        if (!empty($_GET['sku'])) {
            $var['sku'] = $request->query->get('sku');
        }
        if (count($var) == 0) {
            $products = $this->productsRepository->findAll();
            return new JsonResponse($products);
        }
        $products = $this->productsRepository->findBy($var);
        if ($products == null) {
            return new JsonResponse(["No existen registros"], Response::HTTP_CREATED);
        } else {
            foreach ($products as $prod) {
                $data[] = [
                    "id" => $prod->getIdProduct(),
                    "name" => $prod->getName(),
                    "sku" => $prod->getSku(),
                    "date_created" => $prod->getDateCreated(),
                    "slug" => $prod->getSlug(),
                    "date_modified_gmt" => $prod->getDateModifiedGmt(),
                    "date_created_gmt" => $prod->getDateCreatedGmt(),
                    "date_modified" => $prod->getDateModified(),
                    "date_modified_gmt" => $prod->getDateModifiedGmt(),
                    "type" => $prod->getType(),
                    "status" => $prod->getStatus(),
                    "featured" => $prod->getFeatured(),
                    "catalog_visibility" => $prod->getCatalogVisibility(),
                    "description" => $prod->getDescription(),
                    "short_description" => $prod->getShortDescription(),
                    "price" => $prod->getPrice(),

                    "regular_price" => $prod->getRegularPrice(),
                    "date_on_sale_from" => $prod->getDateOnSaleFrom(),
                    "date_on_sale_from_gmt" => $prod->getDateOnSaleFromGmt(),
                    "date_on_sale_to" => $prod->getDateOnSaleTo(),
                    "date_on_sale_to_gmt" => $prod->getDateOnSaleToGmt(),
                    "on_sale" => $prod->getOnSale(),
                    "total_sales" => $prod->getTotalSales(),
                    "stock_quantity" => $prod->getStockQuantity(),
                    "stock_status" => $prod->getStockStatus(),
                    "backorders" => $prod->getBackorders(),
                    "backorders_allowed" => $prod->getBackordersAllowed(),

                ];
            }
            return new JsonResponse($data);
        }
    }

    /**
     * @Route("/{id}", name= "Get a Product", methods="GET")
     */
    public function getProduct($id): JsonResponse
    {
        require __DIR__ . '/../../vendor/autoload.php';


        $woocommerce = new Client(
            'https://testingtiendaonline.cubamodela.com/',
            'ck_f5610087fad2e45d2450d04a3e5a4d508697a6e2',
            'cs_1793afc267a0ac84e1d55cbc764b33bfadf209ea',
            [
                'wp_api' => true,
                'version' => 'wc/v3',

            ]
        );
        try {
            $woocommerce->get('products/' . $id);
            $product = $woocommerce->get('products/' . $id);
            if (!$product) {
                return new JsonResponse("No existen Productos con ese ID");
            }
        } catch (HttpClientException $e) {
            die("Can't get products: $e");
        }
        return new JsonResponse($product);
    }
}