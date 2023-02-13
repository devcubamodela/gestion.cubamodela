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
use Symfony\Component\HttpClient\HttpClient;
use Symfony\Component\HttpFoundation\JsonResponse;
use Automattic\WooCommerce\HttpClient\HttpClientException;


#[Route('/provider')]
class ProviderController extends AbstractController
{

    private $productsRepository;
    private $keyController;
    private $providerRepository;
    private $providerProductRepository;

    public function __construct(KeyController $keyController, ProviderProductRepository $providerProductRepository,ProviderRepository $providerRepository,ProductsRepository $productsRepository)
    {
        $this->productsRepository = $productsRepository;
        $this->keyController = $keyController;
        $this->providerRepository= $providerRepository;
        $this->providerProductRepository= $providerProductRepository;
    }

    #[Route('/getprovaiders', name: 'get_providers_from_woocomerce', methods: ['GET'])]
    public function getProvaider(){
        $page = 1;
        $provider = [];
        $data_provider=[];
        $all_provider = [];
        $data_out[]=[];
        $data_out_product[]=[];
        
        $provider= $this->keyController->keyV2()->get('allproviders');
        foreach ($provider as $prov) {
            $provider=$this->providerRepository->findOneBy(["name"=>$prov->meta_value]);
            if($provider){
                $this->providerRepository->remove($provider);
                $name = $prov->meta_value;
                $codigo="null";
                $this->providerRepository->ProviderRegister($name,$codigo);
                $datnombres_proveed = ["proveedor_nombre" => $prov->meta_value];
                $data_provider = $this->keyController->keyV2()->post('providers', $datnombres_proveed, true);
                foreach ($data_provider as $provid) {
                    $prov_prod= $this->providerProductRepository->findOneBy(["nomb_provider"=>$prov->meta_value,"id_product"=>$provid->post_id]);
                    if($prov_prod){
                        $this->providerProductRepository->remove($prov_prod);
                        $this->providerProductRepository->provid_product_register($name,$provid->post_id,$provid->cost);   
                    }
                    else{
                        $this->providerProductRepository->provid_product_register($name,$provid->post_id,$provid->cost);
                    }
                
            }
            }
            else{
                $name = $prov->meta_value;
                $codigo="null";
                $this->providerRepository->ProviderRegister($name,$codigo);
                $datnombres_proveed = ["proveedor_nombre" => $prov->meta_value];
                $data_provider = $this->keyController->keyV2()->post('providers', $datnombres_proveed, true);
                foreach ($data_provider as $provid) {
                    $prov_prod= $this->providerProductRepository->findOneBy(["nomb_provider"=>$prov->meta_value,"id_product"=>$provid->post_id]);
                    if($prov_prod){
                        $this->providerProductRepository->remove($prov_prod);
                        $this->providerProductRepository->provid_product_register($name,$provid->post_id,$provid->cost);   
                    }
                    else{
                        $this->providerProductRepository->provid_product_register($name,$provid->post_id,$provid->cost);
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
