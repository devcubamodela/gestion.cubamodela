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
use App\Repository\CustomerRepository;
use App\Repository\OrdersProductsRepository;



#[Route('/customers', name: 'app_customers_controllers')]
class CustomersControllersController extends AbstractController
{
    private $keyController;
    private $customerRepository;
    public function __construct(KeyController $keyController, CustomerRepository $customerRepository)
    {
        $this->keyController = $keyController;
        $this->customerRepository= $customerRepository;
        
    }


    #[Route('/', name: 'app_customers_controllers')]
    public function index(): Response
    {
        return $this->render('customers_controllers/index.html.twig', [
            'controller_name' => 'CustomersControllersController',
        ]);
    }
    #[Route('/save', name: 'app_customers_new', methods: ['GET', 'POST'])]
    public function getOrders(): JsonResponse
    {
        $page = 1;
        $customers []= [];
        $all_customers = [];
        do {
            try {
                $customers = $this->keyController->index()->get('customers', array('per_page' => 50, 'page' => $page));
               
            } catch (HttpClientException $e) {
                die("Can't get customers: $e");
            }
            $all_customers = array_merge($all_customers, $customers);
            $page++;
        } while (sizeof($customers) > 0);
        foreach ($all_customers as $cust) {
            $customer = $this->customerRepository->findOneBy(["id_customer" => $cust->id]);
            if (!$customer) {
                $id_customer= $cust->id;        
        $date_created= new \DateTime(date('Y-m-d', strtotime($cust->date_created)));
        $date_created_gmt= new \DateTime(date('Y-m-d', strtotime($cust->date_created_gmt)));
        $date_modified= new \DateTime(date('Y-m-d', strtotime($cust->date_modified)));
        $date_modified_gmt= new \DateTime(date('Y-m-d', strtotime($cust->date_modified_gmt)));
        $email=$cust->email;
        $first_name=$cust->first_name;
        $last_name=$cust->last_name;
        $role=$cust->role;
        $username=$cust->username;
        $billing_firs_name=$cust->billing->first_name;
        $billing_last_name=$cust->billing->last_name;
        $billing_company=$cust->billing->company;
        $billing_address_1=$cust->billing->address_1;
        $billing_address_2=$cust->billing->address_2;
        $billing_city=$cust->billing->city;
        $billing_state=$cust->billing->state;
        $billing_postcode=$cust->billing->postcode;
        $billing_country=$cust->billing->country;
        $billing_email=$cust->billing->email;
        $billing_phone=$cust->billing->phone;
        $shipping_firs_name=$cust->shipping->first_name;
        $shipping_last_name=$cust->shipping->last_name;
        $shipping_company=$cust->shipping->company;
        $shipping_address_1=$cust->shipping->address_1;
        $shipping_address_2=$cust->shipping->address_2;
        $shipping_city=$cust->shipping->city;
        $shipping_state=$cust->shipping->state;
        $shipping_postcode=$cust->shipping->postcode;
        $shipping_country=$cust->shipping->country;
        $is_paying_customer=$cust->is_paying_customer;
                }
                $this->customerRepository->RegisterCustomers(
                $id_customer,
        
        $date_created,
        $date_created_gmt,
        $date_modified,
        $date_modified_gmt,
        $email,
        $first_name,
        $last_name,
        $role,
        $username,
        $billing_firs_name,
        $billing_last_name,
        $billing_company,
        $billing_address_1,
        $billing_address_2,
        $billing_city,
        $billing_state,
        $billing_postcode,
        $billing_country,
        $billing_email,
        $billing_phone,
        $shipping_firs_name,
        $shipping_last_name,
        $shipping_company,
        $shipping_address_1,
        $shipping_address_2,
        $shipping_city,
        $shipping_state,
        $shipping_postcode,
        $shipping_country,
        $is_paying_customer,
                );
        }
        
    return new JsonResponse("Success");
}

}
