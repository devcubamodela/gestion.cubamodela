<?php

namespace App\Controller;

use App\Repository\CustomersRepository;
use Automattic\WooCommerce\Client;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Automattic\WooCommerce\HttpClient\HttpClientException;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

/**
 * @Route("/customers")
 */
class CustomersController extends AbstractController
{
    private $customerRepository;

    public function __construct(CustomersRepository $customerRepository)
    {
        $this->customerRepository = $customerRepository;
    }
    /**
     * @Route("/all")
     */
    public function index(): JsonResponse
    {
        $page = 1;
        $customers = [];
        $all_customers = [];
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
                $customers = $woocommerce->get('customers', array('per_page' => 50, 'page' => $page));
            } catch (HttpClientException $e) {
                die("Can't get products: $e");
            }
            $all_customers = array_merge($all_customers, $customers);
            $page++;
        } while (count($customers) > 0);
        foreach ($all_customers as $cust) {
            $data[] = [
                "id_customers" => $cust->id,
                "date_created" => $cust->date_created,
                "date_created_gmt" => $cust->date_created_gmt,
                "date_modified" => $cust->date_modified,
                "date_modified_gmt" => $cust->date_modified_gmt,
                "email" => $cust->email,
                "first_name" => $cust->first_name,
                "last_name" => $cust->last_name,
                "role" => $cust->role,
                "username" => $cust->username,
                "first_name_biling" => $cust->billing->first_name,
                "last_name_biling" => $cust->billing->last_name,
                "address_1_biling" => $cust->billing->address_1,
                "company_biling" => $cust->billing->company,
                "address_2_biling" => $cust->billing->address_2,
                "city_biling" => $cust->billing->city,
                "state_biling" => $cust->billing->state,
                "postcode_biling" => $cust->billing->postcode,
                "country_biling" => $cust->billing->country,
                "email_biling" => $cust->billing->email,
                "phone_biling" => $cust->billing->phone,

                "first_name_shipping" => $cust->shipping->first_name,
                "last_name_shipping" => $cust->shipping->last_name,
                "company_shipping" => $cust->shipping->company,
                "address_1_shipping" => $cust->shipping->address_1,
                "address_2_shipping" => $cust->shipping->address_2,
                "city_shipping" => $cust->shipping->city,
                "state_shipping" => $cust->shipping->state,
                "postcode_shipping" => $cust->shipping->postcode,
                "country_shipping" => $cust->shipping->country,
                "is_paying_customer" => $cust->is_paying_customer,
                "avatar_url" => $cust->avatar_url,



            ];
        }

        return new JsonResponse($data);
    }
    /**
     * @Route("/updateCustomer", name= "updateCustomer", methods="PUT")
     */
    public function updateCustomer(Request $request): JsonResponse
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
            $woocommerce->put('customers/' . $id, json_decode($request->getContent(), true));
            $customers = $woocommerce->get('customers/' . $id);
            $id = [
                "id_customers" => $customers->id,
                "email" => $customers->email,
                "first_name" => $customers->first_name,
                "last_name" => $customers->last_name,
                "role" => $customers->role,
                "username" => $customers->username,

            ];
        } catch (HttpClientException $e) {
            die("Can't get customers: $e");
        }
        return new JsonResponse("Customers actualizado");
    }


    /**
     * @Route("/save", name= "save_customer", methods="GET")
     */
    public function push_customers(): JsonResponse
    {
        $page = 1;
        $customers = [];
        $all_customers = [];
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
                $customers = $woocommerce->get('customers', array('per_page' => 50, 'page' => $page));
            } catch (HttpClientException $e) {
                die("Can't get products: $e");
            }
            $all_customers = array_merge($all_customers, $customers);
            $page++;
        } while (count($customers) > 0);
        foreach ($all_customers as $cust) {
            $customers = $this->customerRepository->findOneBy(["id_costumer" => $cust->id]);
            if (!$customers) {
                $id_customers = $cust->id;
                $date_created = $cust->date_created;
                $date_created_gmt = $cust->date_created_gmt;
                $date_modified = $cust->date_modified;
                $date_modified_gmt = $cust->date_modified_gmt;
                $email = $cust->email;
                $first_name = $cust->first_name;
                $last_name = $cust->last_name;
                $role = $cust->role;
                $username = $cust->username;
                $first_name_biling = $cust->billing->first_name;
                $last_name_biling = $cust->billing->last_name;
                $address_1_biling = $cust->billing->address_1;
                $company_biling = $cust->billing->company;
                $address_2_biling = $cust->billing->address_2;
                $city_biling = $cust->billing->city;
                $state_biling = $cust->billing->state;
                $postcode_biling = $cust->billing->postcode;
                $country_biling = $cust->billing->country;
                $email_biling = $cust->billing->email;
                $phone_biling = $cust->billing->phone;

                $first_name_shipping = $cust->shipping->first_name;
                $last_name_shipping = $cust->shipping->last_name;
                $company_shipping = $cust->shipping->company;
                $address_1_shipping = $cust->shipping->address_1;
                $address_2_shipping = $cust->shipping->address_2;
                $city_shipping = $cust->shipping->city;
                $state_shipping = $cust->shipping->state;
                $postcode_shipping = $cust->shipping->postcode;
                $country_shipping = $cust->shipping->country;
                $is_paying_customer = $cust->is_paying_customer;
                $avatar_url = $cust->avatar_url;

                $this->customerRepository->CustomerRegister(
                    $id_customers,
                    $date_created,
                    $date_created_gmt,
                    $email,
                    $first_name,
                    $last_name,
                    $role,
                    $username,
                    $first_name_biling,
                    $last_name_biling,
                    $address_1_biling,
                    $company_biling,
                    $address_2_biling,
                    $city_biling,
                    $state_biling,
                    $postcode_biling,
                    $country_biling,
                    $email_biling,
                    $phone_biling,
                    $first_name_shipping,
                    $last_name_shipping,
                    $company_shipping,
                    $address_1_shipping,
                    $address_2_shipping,
                    $city_shipping,
                    $state_shipping,
                    $postcode_shipping,
                    $country_shipping,
                    $is_paying_customer,
                    $avatar_url
                );
            }
        }
        return new JsonResponse("Customers Saved");
    }

    /**
     * @Route("/filter", name= "Filter Costumer", methods="GET")
     */
    public function filterCostumer(Request $request): JsonResponse
    {
        if (empty($_GET['id_costumer']) && empty($_GET['email']) && empty($_GET['username']) && empty($_GET['first_name']) && empty($_GET['last_name'])) {
            $customer = $this->customerRepository->findAll();
            foreach ($customer as $cust) {
                $data[] = [
                    "id_customers" => $cust->id,
                    "date_created" => $cust->date_created,
                    "date_created_gmt" => $cust->date_created_gmt,
                    "date_modified" => $cust->date_modified,
                    "date_modified_gmt" => $cust->date_modified_gmt,
                    "email" => $cust->email,
                    "first_name" => $cust->first_name,
                    "last_name" => $cust->last_name,
                    "role" => $cust->role,
                    "username" => $cust->username,
                    "first_name_biling" => $cust->billing->first_name,
                    "last_name_biling" => $cust->billing->last_name,
                    "address_1_biling" => $cust->billing->address_1,
                    "company_biling" => $cust->billing->company,
                    "address_2_biling" => $cust->billing->address_2,
                    "city_biling" => $cust->billing->city,
                    "state_biling" => $cust->billing->state,
                    "postcode_biling" => $cust->billing->postcode,
                    "country_biling" => $cust->billing->country,
                    "email_biling" => $cust->billing->email,
                    "phone_biling" => $cust->billing->phone,

                    "first_name_shipping" => $cust->shipping->first_name,
                    "last_name_shipping" => $cust->shipping->last_name,
                    "company_shipping" => $cust->shipping->company,
                    "address_1_shipping" => $cust->shipping->address_1,
                    "address_2_shipping" => $cust->shipping->address_2,
                    "city_shipping" => $cust->shipping->city,
                    "state_shipping" => $cust->shipping->state,
                    "postcode_shipping" => $cust->shipping->postcode,
                    "country_shipping" => $cust->shipping->country,
                    "is_paying_customer" => $cust->is_paying_customer,
                    "avatar_url" => $cust->avatar_url,


                ];
            }
            return new JsonResponse($data);
        }

        $var = array();


        if (!empty($_GET['id_costumer'])) {
            $var['id_costumer'] = $request->query->get('id_costumer');
        }
        if (!empty($_GET['email'])) {
            $var['email'] = $request->query->get('email');
        }
        if (!empty($_GET['username'])) {
            $var['username'] = $request->query->get('username');
        }
        if (!empty($_GET['first_name'])) {
            $var['first_name'] = $request->query->get('first_name');
        }
        if (!empty($_GET['last_name'])) {
            $var['last_name'] = $request->query->get('last_name');
        }
        if (count($var) == 0) {
            $customer = $this->customerRepository->findAll();
            return new JsonResponse($customer);
        }
        $customer = $this->customerRepository->findBy($var);
        if ($customer == null) {
            return new JsonResponse(["No existen registros"], Response::HTTP_CREATED);
        } else {
            foreach ($customer as $cust) {
                $data[] = [
                    "id_customers" => $cust->id,
                    "date_created" => $cust->date_created,
                    "date_created_gmt" => $cust->date_created_gmt,
                    "date_modified" => $cust->date_modified,
                    "date_modified_gmt" => $cust->date_modified_gmt,
                    "email" => $cust->email,
                    "first_name" => $cust->first_name,
                    "last_name" => $cust->last_name,
                    "role" => $cust->role,
                    "username" => $cust->username,
                    "first_name_biling" => $cust->billing->first_name,
                    "last_name_biling" => $cust->billing->last_name,
                    "address_1_biling" => $cust->billing->address_1,
                    "company_biling" => $cust->billing->company,
                    "address_2_biling" => $cust->billing->address_2,
                    "city_biling" => $cust->billing->city,
                    "state_biling" => $cust->billing->state,
                    "postcode_biling" => $cust->billing->postcode,
                    "country_biling" => $cust->billing->country,
                    "email_biling" => $cust->billing->email,
                    "phone_biling" => $cust->billing->phone,

                    "first_name_shipping" => $cust->shipping->first_name,
                    "last_name_shipping" => $cust->shipping->last_name,
                    "company_shipping" => $cust->shipping->company,
                    "address_1_shipping" => $cust->shipping->address_1,
                    "address_2_shipping" => $cust->shipping->address_2,
                    "city_shipping" => $cust->shipping->city,
                    "state_shipping" => $cust->shipping->state,
                    "postcode_shipping" => $cust->shipping->postcode,
                    "country_shipping" => $cust->shipping->country,
                    "is_paying_customer" => $cust->is_paying_customer,
                    "avatar_url" => $cust->avatar_url,

                ];
            }
            return new JsonResponse($data);
        }
    }
}