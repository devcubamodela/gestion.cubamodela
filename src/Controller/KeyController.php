<?php

namespace App\Controller;

use App\Entity\Claves;
use App\Repository\ClavesRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request as Req;
use Symfony\Component\Routing\Annotation\Route;
use Automattic\WooCommerce\Client;
use Automattic\WooCommerce\HttpClient\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

#[Route('/key', name: 'app_key_new')]
class KeyController extends AbstractController
{
    private $clavesRepository;
    public function __construct(ClavesRepository $clavesRepository){
        $this->clavesRepository= $clavesRepository;
    }

    public function index()
    {
        
        require __DIR__ . '/../../vendor/autoload.php';
        $woocommerce = new Client(
            'https://testing.cbmtienda.com/',
            'ck_f9c2b4aed594b08fb9a2c0907fd584f000e4d086',
            'cs_f290ab654c250be7dd279ea81ffba752298ba045',
            [
                'wp_api' => true,
                'version' => 'wc/v3',
                'timeout' => 200,

            ]
        );
        return $woocommerce;
    }
    // public function keyV2(){
    //     require __DIR__ . '/../../vendor/autoload.php';
    //     $woocommerce = new Client(
    //         'https://testing.cbmtienda.com/',,
    //         [
    //             'wp_json' => true,
    //             'version' => 'wp/v2',
    //             'timeout' => 200,
    
    //         ]
    //     );

    //   return $woocommerce;
    // }
    #[Route('/save', name: 'saveKey', methods: ['GET', 'POST'])]
    public function saveKey(Req $request):Response{
        $ck=json_decode($request->getContent(),false)->ck;
        $cs=json_decode($request->getContent(),false)->cs;
        $this->clavesRepository->RegisterKeys($ck,$cs);

      return new JsonResponse("super");
    }
}
