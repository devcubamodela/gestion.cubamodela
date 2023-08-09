<?php

namespace App\Controller;

use App\Entity\Provider;
use App\Form\ProviderType;
use App\Repository\ProviderRepository;
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
use Symfony\Component\HttpFoundation\JsonResponse;
use Automattic\WooCommerce\HttpClient\HttpClientException;
use App\Repository\OrdersRepository;
use PHPUnit\Framework\Constraint\IsEmpty;

use App\Repository\OrdersProductsRepository;
#[Route('/provider')]
class ProviderController extends AbstractController
{

    private $productsRepository;
    private $keyController;
    private $providerRepository;
    private $providerProductRepository;
    private $ordersRepository;
    private $ordersProductRepository;

    public function __construct(OrdersProductsRepository $ordersProductRepository ,KeyController $keyController, OrdersRepository $ordersRepository, ProviderProductRepository $providerProductRepository, ProviderRepository $providerRepository, ProductsRepository $productsRepository)
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



        return $this->render('provider/index.html.twig');
    }


    #[Route('/getprovaiders', name: 'get_providers_data', methods: ['GET'])]
    public function getProvaider(Request $request)
    {
        $orders = [];
        $ordersTest = [];
        $requestIdProveedor = json_decode($request->getContent())->id;
        $productos=$this->providerProductRepository->findBy(['Id_Prvider'=>$requestIdProveedor]);
        foreach($productos as $prod){
            $orders=$this->ordersProductRepository->findBy(["id_product"=>$prod->getIdProduct()]);
            $ordersTest= $this->getDeliveredOrders($orders);  
            $dataout[]=[
                "IdProducto"=>$prod->getIdProduct(),
                "Cant Vendidos"=>sizeof($ordersTest),

                "Fechas de Ordenes"=>$ordersTest

            ];
           
        }
       

        return new JsonResponse($dataout);
    }
    
    public function getDeliveredOrders($orders){
       $ordersOut= [];
        if(sizeof($orders)>0){
            foreach($orders as $ord){
                array_push($ordersOut,$this->ordersRepository->findBy(["orderId"=>$ord->getIdOrder(), "status"=>"entregado"],['date_paid' => 'DESC']));
            }
            foreach($ordersOut as $orden){
                foreach($orden as $aux){
                    $date=$aux->getDatePaid();
                    $data[]=[
                        "ID"=>$aux->getOrderId(),
                        
                        "fecha"=>date_format($date, 'Y-m-d')
                       ];
                }
               
             }
           
        }
        return $data;
    }

    #[Route('/saveProvider', name: 'save_providers', methods: ['POST'])]
    public function saveProvider(Request $request)
    {
        if(!empty($request)){
            $requestAux = json_decode($request->getContent());
         foreach($requestAux as $prov){
              $idProvider= $prov->id;
              $name= $prov->name;
              $codigo= $prov->codigo;
              $productid= $prov->productid;
              if(!$this->existeProveedor($idProvider, $name)){
                $this->providerRepository->ProviderRegister($idProvider, $name, $codigo);
                foreach($productid as $products){
                   $prodId= $products->prodId;
                   $cost = $products->cost;
                   $this->providerProductRepository->provid_product_register($idProvider,$prodId,$cost);
                }
                
              }
              
              
         }
        }
        else{
            return  new Response("No hay datos");
        }
        return  new Response("Proveedores salvados");
    }


    public function existeProveedor($id,$name){

          $provider= $this->providerRepository->findOneBy(["id_Proveedor" => $id,"name" => $name]);
          if($provider){
              return true;
          }
          else{return false;}

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
