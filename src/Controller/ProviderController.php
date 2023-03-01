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
use Symfony\Component\HttpClient\HttpClient;
use Symfony\Component\HttpFoundation\JsonResponse;
use Automattic\WooCommerce\HttpClient\HttpClientException;
use App\Repository\OrdersRepository;


#[Route('/provider')]
class ProviderController extends AbstractController
{

    private $productsRepository;
    private $keyController;
    private $providerRepository;
    private $providerProductRepository;
    private $ordersRepository;

    public function __construct(KeyController $keyController, OrdersRepository $ordersRepository, ProviderProductRepository $providerProductRepository, ProviderRepository $providerRepository, ProductsRepository $productsRepository)
    {
        $this->productsRepository = $productsRepository;
        $this->keyController = $keyController;
        $this->providerRepository = $providerRepository;
        $this->providerProductRepository = $providerProductRepository;
        $this->ordersRepository = $ordersRepository;
    }
    #[Route('/', name: 'app_provider_index', methods: ['GET'])]
    public function index(): Response
    {
        $data[]=[];
        $orders = $this->ordersRepository->findBy(['status' => 'entregado']);
        foreach ($orders as $ord) {
            foreach($ord->getProductos() as $product){
                $proveedor= $this->providerProductRepository->findOneBy(["id_product"=>$product->product_id]);
              if($proveedor){
                    $producto= $this->productsRepository->findOneBy(["idProduct"=>$product->product_id]);
            $data []= [
                "id_order" => $ord->getOrderId(),
                "id_producto"=>$producto->getIdProduct(),
                "order_date"=>$ord->getDateCreated(),
                "proc_name"=>$proveedor->getNombProvider(),
                "prod_name"=>$producto->getName()

            ];
            }



            }
        }

        
        return $this->render('provider/index.html.twig');
    }


    #[Route('/getprovaiders', name: 'get_providers_from_woocomerce', methods: ['GET'])]
    public function getProvaider()
    {
        $page = 1;
        $provider = [];
        $data_provider = [];
        $all_provider = [];
        $data_out[] = [];
        $data_out_product[] = [];

        $provider = $this->keyController->keyV2()->get('allproviders');
        foreach ($provider as $prov) {
            $provider = $this->providerRepository->findOneBy(["name" => $prov->meta_value]);
            if (!$provider) {
                $name = $prov->meta_value;
                $codigo = "null";
                $this->providerRepository->ProviderRegister($name, $codigo);
                $datnombres_proveed = ["proveedor_nombre" => $prov->meta_value];
                $data_provider = $this->keyController->keyV2()->post('providers', $datnombres_proveed, true);
                foreach ($data_provider as $provid) {
                    $prov_prod = $this->providerProductRepository->findOneBy(["nomb_provider" => $prov->meta_value, "id_product" => $provid->post_id]);
                    if (!$prov_prod) {
                        $this->providerProductRepository->provid_product_register($name, $provid->post_id, $provid->cost);
                    } else {
                        $this->providerProductRepository->provid_product_register($name, $provid->post_id, $provid->cost);
                    }
                }
            }
        }


        return new JsonResponse("salvado providers");
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