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
use App\Entity\Products;
use PhpParser\Node\Expr\Empty_;
use Automattic\WooCommerce\Client;
use PhpParser\Node\Expr\ArrayItem;
use App\Controller\GlobalFuntionsController;
use Symfony\Component\HttpClient\HttpClient;
use Symfony\Component\HttpFoundation\JsonResponse;
use Automattic\WooCommerce\HttpClient\HttpClientException;


#[Route('/provider')]
class ProviderController extends AbstractController
{

    private $productsRepository;
    private $keyController;
    private $providerRepository;

    public function __construct(KeyController $keyController, ProviderRepository $providerRepository,ProductsRepository $productsRepository)
    {
        $this->productsRepository = $productsRepository;
        $this->keyController = $keyController;
        $this->providerRepository= $providerRepository;
    }

    #[Route('/getprovaiders', name: 'get_providers_from_woocomerce', methods: ['GET'])]
    public function getProvaider(){
        $page = 1;
        $provider = [];
        $data_provider=[];
        $all_provider = [];
        $data_out[]=[];
        $data_out_product[]=[];
        

        $woocommerce = new Client(
            'https://testingtiendaonline.cubamodela.com/',
            'ck_9165c363f548a688c68e2c6fa3fd6ecddcf80c99',
            'cs_fc6cf6161c04ef01684a8e4ba41200e94bdef29a',
            [
                'wp_api' => true,
                'version' => 'wp/v2',
                'timeout' => 120,

            ]
        );
        $provider= $this->keyController->keyV2()->get('allproviders');
        foreach ($provider as $prov) {
            
            $data= [ "proveedor_nombre"=>$prov->meta_value];
               
            
            $data_provider= $this->keyController->keyV2()->post('providers',$data, true);
            foreach($data_provider as $provid){
                $product = $this->productsRepository->findOneBy(["idProduct" => $provid->post_id]);
                if($product){
                   $this->providerRepository->ProviderRegister($prov->meta_value, $provid->post_id,$product->getSku(),$product->getName(),$provid->cost,$product->getTotalSales());
                }
                
                
            }
        }
        $var= sizeof($data_out_product);
        return new JsonResponse($data_out_product);

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
