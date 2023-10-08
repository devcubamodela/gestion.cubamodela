<?php

namespace App\Controller;

use App\Entity\Provider;
use App\Form\ProviderType;
use App\Repository\ProviderRepository;
use ArrayObject;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

use Symfony\Component\Routing\Annotation\Route;

use Doctrine\ORM\EntityManagerInterface;
use App\Controller\KeyController;
use App\Repository\ProductsRepository;
use App\Repository\ProviderProductRepository;
use App\Entity\Products;
use PhpParser\Node\Expr\Empty_;
use Automattic\WooCommerce\Client;
use PhpParser\Node\Expr\ArrayItem;
use App\Controller\GlobalFuntionsController;
use App\Entity\Orders;
use App\Entity\OrdersProducts;
use Symfony\Component\HttpClient\HttpClient;
use Illuminate\Support\Facades\Http;
use Symfony\Component\HttpFoundation\JsonResponse;
use Automattic\WooCommerce\HttpClient\HttpClientException;
use App\Repository\OrdersRepository;
use PHPUnit\Framework\Constraint\IsEmpty;

use App\Repository\OrdersProductsRepository;

#[Route('/web/provider')]
class ProviderController extends AbstractController
{

    private $productsRepository;
    private $keyController;
    private $providerRepository;
    private $providerProductRepository;
    private $ordersRepository;
    private $ordersProductRepository;

    public function __construct(OrdersProductsRepository $ordersProductRepository, KeyController $keyController, OrdersRepository $ordersRepository, ProviderProductRepository $providerProductRepository, ProviderRepository $providerRepository, ProductsRepository $productsRepository)
    {
        $this->productsRepository = $productsRepository;
        $this->keyController = $keyController;
        $this->providerRepository = $providerRepository;
        $this->providerProductRepository = $providerProductRepository;
        $this->ordersRepository = $ordersRepository;
        $this->ordersProductRepository = $ordersProductRepository;
    }
    #[Route('/', name: 'app_provider_index', methods: ['GET'])]
    public function index(): Response
    {
        $totalVendidos=0;
        $user =$this->getUser()->getUserIdentifier() ;
        $providerIn = $this->providerRepository->findOneBy(['email' => $this->getUser()->getUserIdentifier()]);
        $productos = $this->providerProductRepository->findBy(['Id_Prvider' => $providerIn->getIdProveedor()]);
       foreach ($productos as $prod) {
            $orders = $this->ordersProductRepository->findBy(["id_product" => $prod->getIdProduct()]);
            $ordersTest = $this->getDeliveredOrders($orders);
            $totalVendidos= sizeof($ordersTest) + $totalVendidos;
            $dataToShow[] = [
                "IdProducto" => $prod->getIdProduct(),
                "Cant_Vendidos" => sizeof($ordersTest),
                "Costo"=>sizeof($ordersTest)*$prod->getCost(),
                "Fechas_de_Ordenes" => $ordersTest,
               

            ];
        }
        // $dataObjects = new ArrayObject($dataToShow);
        //     $dataOutOrder= usort($dataObjects, $this->object_sorter('Fechas_de_Ordenes')); 
        //     return new JsonResponse($dataObjects);
          return $this->render('provider/index.html.twig',['data'=>$dataToShow,'total'=>$totalVendidos]);
    }

    function object_sorter($clave,$orden=null) {
        return function ($a, $b) use ($clave,$orden) {
              $result=  ($orden=="DESC") ? strnatcmp($b->$clave, $a->$clave) :  strnatcmp($a->$clave, $b->$clave);
              return $result;
        };
    }
    #[Route('/dataOfSells/{variable}', name:'sell_product_history', methods: ['Get'])]
    public function productsSellsDataHistory($variable):Response
    {
        $orders= $this->ordersProductRepository->findBy(["id_product" => $variable]);
        $product=$this->productsRepository->findOneBy(["idProduct"=> $variable]);
        
           
        
         
        
        foreach($orders as $ord){
            $order= $this->ordersRepository->findOneBy(["orderId"=>$ord->getIdOrder()]);
            $dataOrder[]=[
                "idOrder"=>$order->getOrderId(),
                "fechaEntregado"=>date_format($order->getDatePaid(), 'Y-m-d'),
            ];
           
        }
        
       
        return $this->render('provider/productOrdersDataHistory.html.twig',['dataOrders'=>$dataOrder,'productId'=> $product->getIdProduct(),'productName'=> $product->getName(),'productSku'=>$product->getSku()]);
    }

    #[Route('/saveProviderAPI', name: 'save_providers_api', methods: ['GET'])]
    public function saveProviderApi()
    {
        $page = 1;
        $provider = [];
        $all_provider = [];

        $client= HttpClient::create();
        $response = $client->request('GET','http://testing.cbmtienda.com/wp-json/wp/v2/providers/');
        $providers = json_decode($response->getContent(),true);
        foreach ($providers as $prov) {
            $idProvider = $prov["id"];
            $name = $prov["name"];
            $codigo = $prov["code"];
            $productid = $prov["productid"];
           if (!$this->existeProveedor($idProvider, $name)) {
                $this->providerRepository->ProviderRegister($idProvider, $name, $codigo);
                foreach ($productid as $products) {
                    $prodId = $products;
                    $cost = 15;
                    $data[]=[
                        "idProvider"=>$idProvider,
                        "ProductoID"=>$prodId,
                        "costo"=>$cost
                    ];
                    $this->providerProductRepository->provid_product_register($idProvider, $prodId, $cost);
                  
                }
            }
           
        }
        return  new JsonResponse("Proveedores salvador");
    }


    #[Route('/getprovaiders', name: 'get_providers_data', methods: ['GET'])]
    public function getProvaider(Request $request)
    {
        $orders = [];
        $ordersTest = [];
        $requestIdProveedor = json_decode($request->getContent())->id;
        
        $productos = $this->providerProductRepository->findBy(['id_provider' => $requestIdProveedor]);
        foreach ($productos as $prod) {
            $orders = $this->ordersProductRepository->findBy(["id_product" => $prod->getIdProduct()]);
            $ordersTest = $this->getDeliveredOrders($orders);
            $dataout[] = [
                "IdProducto" => $prod->getIdProduct(),
                "Cant Vendidos" => sizeof($ordersTest),

                "Fechas de Ordenes" => $ordersTest

            ];
        }


        return new JsonResponse($dataout);
    }

    public function getDeliveredOrders($orders)
    {
        $ordersOut = [];
        if (sizeof($orders) > 0) {
            foreach ($orders as $ord) {
                array_push($ordersOut, $this->ordersRepository->findBy(["orderId" => $ord->getIdOrder(), "status" => "entregado"], ['date_paid' => 'DESC']));
            }
            foreach ($ordersOut as $orden) {
                foreach ($orden as $aux) {
                    $date = $aux->getDatePaid();
                    $data[] = [
                        "ID" => $aux->getOrderId(),

                        "fecha" => date_format($date, 'Y-m-d')
                    ];
                }
            }
        }
        return $data;
    }

    #[Route('/saveProvider', name: 'save_providers', methods: ['Post'])]
    public function saveProvider(Request $request)
    {
        if (!empty($request)) {
            $requestAux = json_decode($request->getContent());

            foreach ($requestAux as $prov) {
               $idProvider = $prov->id;
                $name = $prov->name;
                $codigo = $prov->codigo;
                $productid = $prov->productid;
               
                if (!$this->existeProveedor($idProvider, $name)) {
                    $this->providerRepository->ProviderRegister($idProvider, $name, $codigo);
                    foreach ($productid as $products) {
                        $prodId = $products->prodId;
                        $cost = $products->cost;
                        $this->providerProductRepository->provid_product_register($idProvider, $prodId, $cost);
                    }
                }
            }
        } else {
            return  new Response("No hay datos");
        }
        return  new Response("Proveedores salvados");
       
    }


    public function existeProveedor($id, $name)
    {

        $provider = $this->providerRepository->findOneBy(["id_Proveedor" => $id, "name" => $name]);
        if ($provider) {
            return true;
        } else {
            return false;
        }
    }
    // #[Route('/', name: 'app_provider_index', methods: ['GET'])]
    // public function index(ProviderRepository $providerRepository): Response
    // {
    //     return $this->render('provider/index.html.twig', [
    //         'providers' => $providerRepository->findAll(),
    //     ]);
    // }

    // #[Route('/new', name: 'app_provider_new', methods: ['GET', 'POST'])]
    // public function new(Request $request, EntityManagerInterface $entityManager): Response
    // {
    //     $provider = new Provider();
    //     $form = $this->createForm(ProviderType::class, $provider);
    //     $form->handleRequest($request);

    //     if ($form->isSubmitted() && $form->isValid()) {
    //         $provider->setConsecutive(0);
    //         $entityManager->persist($provider);
    //         $entityManager->flush();

    //         return $this->redirectToRoute('app_provider_index', [], Response::HTTP_SEE_OTHER);
    //     }

    //     return $this->renderForm('provider/new.html.twig', [
    //         'provider' => $provider,
    //         'form' => $form,
    //     ]);
    // }

    // #[Route('/{id}', name: 'app_provider_show', methods: ['GET'])]
    // public function show(Provider $provider): Response
    // {
    //     return $this->render('provider/show.html.twig', [
    //         'provider' => $provider,
    //     ]);
    // }

    // #[Route('/{id}/edit', name: 'app_provider_edit', methods: ['GET', 'POST'])]
    // public function edit(Request $request, Provider $provider, EntityManagerInterface $entityManager): Response
    // {
    //     $form = $this->createForm(ProviderType::class, $provider);
    //     $form->handleRequest($request);

    //     if ($form->isSubmitted() && $form->isValid()) {
    //         $entityManager->flush();

    //         return $this->redirectToRoute('app_provider_index', [], Response::HTTP_SEE_OTHER);
    //     }

    //     return $this->renderForm('provider/edit.html.twig', [
    //         'provider' => $provider,
    //         'form' => $form,
    //     ]);
    // }

    // #[Route('/{id}', name: 'app_provider_delete', methods: ['POST'])]
    // public function delete(Request $request, Provider $provider, EntityManagerInterface $entityManager): Response
    // {
    //     if ($this->isCsrfTokenValid('delete'.$provider->getId(), $request->request->get('_token'))) {
    //         $entityManager->remove($provider);
    //         $entityManager->flush();
    //     }

    //     return $this->redirectToRoute('app_provider_index', [], Response::HTTP_SEE_OTHER);
    // }



}
