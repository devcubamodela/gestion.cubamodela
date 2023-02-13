<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\OrdersRepository;
use App\Entity\Products;
use PhpParser\Node\Expr\Empty_;
use Automattic\WooCommerce\Client;
use PhpParser\Node\Expr\ArrayItem;
use App\Repository\ProductsRepository;
use App\Controller\GlobalFuntionsController;
use Symfony\Component\HttpClient\HttpClient;
use Symfony\Component\HttpFoundation\JsonResponse;
use Automattic\WooCommerce\HttpClient\HttpClientException;
use App\Controller\KeyController;


#[Route('/orders')]

class OrdersController extends AbstractController
{
    private $keyController;
    private $ordersRepository;
    

    public function __construct(KeyController $keyController, OrdersRepository $ordersRepository)
    {
        $this->keyController = $keyController;
        $this->ordersRepository = $ordersRepository;
    }

    public function key()
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
    #[Route('/', name: 'app_orders_index', methods: ['GET'])]
    public function index(OrdersRepository $ordersRepository): Response
    {
        return $this->render('orders/index.html.twig', [
            'orders' => $ordersRepository->findAll(),
        ]);
    }
     /**
     * @Route("/countall", name= "countAllOrders")
     */
    public function countAllOrders()
    {
        $orders = sizeof($this->ordersRepository->findAll());
        return new JsonResponse($orders);
    }
    #[Route('/save', name: 'app_orders_new', methods: ['GET', 'POST'])]
    public function saveInBd(): JsonResponse
    {
        $page = 1;
        $orders = [];
        $all_orders = [];
        do {
            try {
                $orders = $this->keyController->index()->get('orders', array('per_page' => 50, 'page' => $page));
                foreach ($orders as $ord) {
                    $order = $this->ordersRepository->findOneBy(["orderId" => $ord->id]);
                    if (!$order) {
                        $orderId = $ord->id;
                        $parent_id = $ord->parent_id;
                        $number = $ord->number;
                        $order_key = $ord->order_key;
                        $created_via = $ord->created_via;
                        $version = $ord->version;
                        $status = $ord->status;
                        $currency = $ord->currency;
                        $date_created = $ord->date_created;
                        $date_modified = $ord->date_modified;
                        $discount_total = $ord->discount_total;
                        $discount_tax = $ord->discount_tax;
                        $shipping_total = $ord->shipping_total;
                        $shipping_tax = $ord->shipping_tax;
                        $cart_tax = $ord->cart_tax;
                        $total = $ord->total;
                        $prices_include_tax = $ord->prices_include_tax;
                        $customer_id = $ord->customer_id;
                        $customer_ip_address = $ord->customer_ip_address;
                        $customer_user_agent = $ord->customer_user_agent;
                        $customer_note = $ord->customer_note;
                        $billing_first_name = $ord->billing->first_name;
                        $billing_last_name = $ord->billing->last_name;
                        $billing_address_1 = $ord->billing->address_1;
                        $billing_email = $ord->billing->email;
                        $billing_phone = $ord->billing->phone;
                        $shipping_first_name = $ord->shipping->first_name;
                        $shipping_last_name = $ord->shipping->last_name;
                        $shipping_address_1 =$ord->shipping->address_1;
                        $payment_method = $ord->payment_method;
                        $payment_method_title = $ord->payment_method_title;
                        $date_paid = $ord->date_paid;
                        $productos=$ord->line_items;
                        
                        
            
                        $this->ordersRepository->RegisterOrders($orderId,
                        $parent_id,
                        $number,
                        $order_key,
                        $created_via,
                        $version,
                        $status,
                        $currency,
                        $date_created,
                        $date_modified,
                        $discount_total,
                        $discount_tax,
                        $shipping_total,
                        $shipping_tax,
                        $cart_tax,
                        $total,
                        $prices_include_tax,
                        $customer_id,
                        $customer_ip_address,
                        $customer_user_agent,
                        $customer_note,
                        $billing_first_name,
                        $billing_last_name,
                        $billing_address_1,
                        $billing_email,
                        $billing_phone,
                        $shipping_first_name,
                        $shipping_last_name,
                        $shipping_address_1,
                        $payment_method,
                        $payment_method_title,
                        $date_paid,
                        $productos);
                    }
                }
            } catch (HttpClientException $e) {
                die("Can't get orders: $e");
            }
            $all_orders = array_merge($all_orders, $orders);
            $page++;
        } while (count($orders) > 0);
        
    return new JsonResponse(sizeof($all_orders));
}
    
    
}
