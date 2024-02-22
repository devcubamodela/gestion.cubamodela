<?php

namespace App\Controller;

use App\Entity\Economia;
use App\Form\EconomiaType;
use App\Repository\EconomiaRepository;
use App\Repository\OrdersProductsRepository;
use App\Repository\ProviderProductRepository;
use App\Repository\ProviderRepository;
use App\Repository\ProductsRepository;
use App\Repository\UserRepository;
use App\Repository\OrdersRepository;
use Doctrine\ORM\EntityManagerInterface;
use PHPUnit\Util\Json;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Knp\Component\Pager\PaginatorInterface;

#[Route('/web/economia')]
class EconomiaController extends AbstractController
{
    private $productsRepository;
    private $keyController;
    private $providerRepository;
    private $providerProductRepository;
    private $ordersRepository;
    private $ordersProductRepository;
    private $economiaRepository;
    private $userRepository;
    

    public function __construct(UserRepository $userRepository, EconomiaRepository $economiaRepository, OrdersProductsRepository $ordersProductRepository, KeyController $keyController, OrdersRepository $ordersRepository, ProviderProductRepository $providerProductRepository, ProviderRepository $providerRepository, ProductsRepository $productsRepository)
    {
        $this->productsRepository = $productsRepository;
        $this->keyController = $keyController;
        $this->providerRepository = $providerRepository;
        $this->providerProductRepository = $providerProductRepository;
        $this->ordersRepository = $ordersRepository;
        $this->ordersProductRepository = $ordersProductRepository;
        $this->economiaRepository = $economiaRepository;
        $this->userRepository = $userRepository;
    }
    #[Route('/fill', name: 'app_economia_fill', methods: ['GET'])]
    public function fillTables(): JsonResponse
    {
        $i=0;
        $orders = $this->ordersProductRepository->findAll();
        foreach ($orders as $order) {

            $idOrden = $order->getIdOrder();
            $idproduct = $order->getIdProduct();
            $idProveedorder = $this->providerProductRepository->findOneBy(['id_product' => $idproduct]);
            $exist = $this->economiaRepository->findOneBy(['idOrden' => $idOrden, 'idProducto' => $idproduct]);
           
            if (!$exist) {
            if($idProveedorder != null){
                $idProvider=$idProveedorder->getIdPrvider();
                $cost = $idProveedorder->getCost();
                $pagado = false;
            }
            else{
                $pagado = false;
                $cost=0;
                $idProvider=0;
            }
            $dateSold= $this->ordersRepository->findOneBy(['orderId' => $idOrden]);
            if ($dateSold != null) {
                $month = $dateSold->getDateCreated()->format('m');
                $year = $dateSold->getDateCreated()->format('Y');
                $date = $month . "/" . $year;
            }else{
                $date=null;
            }
            $this->economiaRepository->RegisterOrderToPay($idOrden, $idproduct,$idProvider,$cost,$pagado,$date );
           }
           
           $i++;
        }
        return new JsonResponse($i);
        
    }

    #[Route('/', name: 'app_economia_index', methods: ['GET'])]
    public function index(EconomiaRepository $economiaRepository): Response
    {
       
        $user = $this->userRepository->findOneBy(['email' => $this->getUser()->getUserIdentifier()]);
        $roles = $user->getRoles();
        $elementos = $economiaRepository->findAll();
        
       
       // $arrayNoOrdenado=$this->customGroupByMonth($elementos);
        $arrayToOutput= $this->groupData($elementos);
            
        // if (in_array("ROLE_ECONOMIA", $user->getRoles())) {
            return $this->render('economia2/index.html.twig', [
                'economias' =>$arrayToOutput,
            ]);
            
        // } else {

        //     return $this->render('error/index.html.twig');
        // }
    }

    public function groupData($array){
        $groups = [];
        foreach ($array as $item) {
          $keyVal = $item->getFechaOrdenEfectuada();
          if (!isset($groups[$keyVal])) {
            $groups[$keyVal] = [];
          }
          $groups[$keyVal][] = $item;
        }
return $groups;
    }

    public function customGroupByMonth($elementos)
    {
        $arrayOut = [];
        foreach ($elementos as $element) {
            $productoName = $this->productsRepository->findOneBy(['idProduct' => $element->getIdProducto()]);
            $dateSold = $this->ordersRepository->findOneBy(['orderId' => $element->getIdOrden()]);
            if ($productoName != null && $dateSold != null) {
                $month = $dateSold->getDateCreated()->format('m');
                $year = $dateSold->getDateCreated()->format('Y');
                $date = $month . "/" . $year;
                $pagado = $element->isPagado();
                $elementsOut = [
                   "nombre"=> $productoName->getName(),
                    "fecha"=> $date,
                      "pagado"=>$pagado,
                      "costo"=>""
                ];
                $providerProduct = $this->providerProductRepository->findOneBy(['id_product' => $element->getIdProducto()]);
                if ($providerProduct != null) {
                    $cost = $providerProduct->getCost();
                    $elementsOut = [
                        "nombre"=> $productoName->getName(),
                    "fecha"=> $date,
                      "pagado"=>$pagado,
                      "costo"=> $cost
                    ];
                }
                array_push($arrayOut, $elementsOut);
            }
        }
        return $arrayOut;
    }

    #[Route('/new', name: 'app_economia_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $economium = new Economia();
        $form = $this->createForm(EconomiaType::class, $economium);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($economium);
            $entityManager->flush();

            return $this->redirectToRoute('app_economia_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('economia/new.html.twig', [
            'economium' => $economium,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_economia_show', methods: ['GET'])]
    public function show(Economia $economium): Response
    {
        return $this->render('economia/show.html.twig', [
            'economium' => $economium,
        ]);
    }
    #[Route('/filterOrder', name: 'app_economia_filter', methods: ['POST'])]
    public function filter(Request $request): Response
    {
        $orders =  $this->economiaRepository->findBy(['idOrden' => $request->get('test')]);
        return $this->render('economia/index.html.twig', [
            'economias' => $orders,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_economia_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Economia $economium, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(EconomiaType::class, $economium);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_economia_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('economia/edit.html.twig', [
            'economium' => $economium,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_economia_delete', methods: ['POST'])]
    public function delete(Request $request, Economia $economium, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete' . $economium->getId(), $request->request->get('_token'))) {
            $entityManager->remove($economium);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_economia_index', [], Response::HTTP_SEE_OTHER);
    }
}
