<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\OrdersRepository;
use App\Repository\ProviderProductRepository;

#[Route('/ventas')]
class VentasController extends AbstractController
{
    private $keyController;
    private $ordersRepository;
    private $providerProductRepository;


    public function __construct(KeyController $keyController, ProviderProductRepository $providerProductRepository,OrdersRepository $ordersRepository)
    {
        $this->keyController = $keyController;
        $this->ordersRepository = $ordersRepository;
        $this->providerProductRepository = $providerProductRepository;

    }

    #[Route('/', name: 'app_ventas')]
    public function index(): JsonResponse
    {
        $orders = $this->ordersRepository->findBy(['status' => 'entregado']);
        if ($orders == null) {
            return new JsonResponse("Tsas Jodido chama");
        }
        foreach ($orders as $ord) {
            foreach ($ord->getProductos() as $prod) {
              list($nomb,$cost)= $this->Buscar_provv_prod($prod->id);
                $data[] = [
                    "id_ord" => $ord->getNumber(),
                    "name" => $prod->name,
                    "id" => $prod->id,
                    "fecha" => $ord->getDateCreated(),
                    "nombre_prov"=>$nomb,
                    "cost_prov"=>$cost,
                ];
            }
        }


        return new JsonResponse($data);
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
