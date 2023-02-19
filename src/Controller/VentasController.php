<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\OrdersRepository;
use App\Repository\ProviderProductRepository;
use App\Repository\ProductsRepository;
use App\Repository\ProductVariationRepository;

#[Route('/ventas')]
class VentasController extends AbstractController
{
    private $keyController;
    private $ordersRepository;
    private $providerProductRepository;
    private $productRepository;
    private $productVariantRepository;


    public function __construct(KeyController $keyController,ProductVariationRepository $productVariantRepository,ProductsRepository $productRepository, ProviderProductRepository $providerProductRepository,OrdersRepository $ordersRepository)
    {
        $this->keyController = $keyController;
        $this->ordersRepository = $ordersRepository;
        $this->providerProductRepository = $providerProductRepository;
        $this->productRepository = $productRepository;
        $this->productVariantRepository = $productVariantRepository;

    }

    #[Route('/', name: 'app_ventas')]
    public function index(): Response
    {
        $orders = $this->ordersRepository->findBy(['status' => 'entregado']);
        if ($orders == null) {
            return new JsonResponse("Error");
        }
        foreach ($orders as $ord) {
            foreach ($ord->getProductos() as $prod) {
                list($nomb,$cost)= $this->Buscar_provv_prod($prod->product_id);
                $producto=$this->productRepository->findOneBy(['idProduct'=>$prod->product_id ]);
                if($producto){
                    
                    $data[] = [
                        "id_ord" => $ord->getNumber(),
                        "name" => $prod->name,
                        "id_producto" => $prod->product_id,
                        "fecha" => $ord->getDateCreated(),
                        "nombre_prov"=>$nomb,
                        "cost_prov"=>$cost,
                        "prec_vent"=>$producto->getPrice(),
                    ];
                }
                else{
                
                    $data[] = [
                        "id_ord" => $ord->getNumber(),
                        "name" => $prod->name,
                        "id_producto" => $prod->product_id,
                        "fecha" => $ord->getDateCreated(),
                        "nombre_prov"=>$nomb,
                        "cost_prov"=>$cost,
                        "prec_vent"=>"0",
                    ];
                }
               
                }
            }
        
       
        return $this->render('ventas/index.html.twig', [
            'ventas' => $data,
        ]);
    }

    public function Buscar_provv_prod($number){
    $provider = $this->providerProductRepository->findAll();
     $nomb="";
     $cost="";
        foreach ($provider as $prov) {
            $nomb_prov=$this->providerProductRepository->findOneBy(["id_product"=>$number]);
           if($nomb_prov){
            $cost=$prov->getCost();
            $nomb= $prov->getNombProvider();
            return [$nomb,$cost];
           }
        }
        return [$nomb,$cost];
    }
}
