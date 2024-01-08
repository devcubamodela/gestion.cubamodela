<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Economia;
use App\Form\EconomiaType;
use App\Repository\EconomiaRepository;
use App\Repository\OrdersProductsRepository;
use App\Repository\ProviderProductRepository;
use App\Repository\ProviderRepository;
use App\Repository\ProductsRepository;
use App\Repository\UserRepository;
use App\Repository\OrdersRepository;
use App\Repository\AlmacenRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;



#[Route('/web/almacen')]
class AlmacenController extends AbstractController{
    private $productsRepository;
    private $keyController;
    private $providerRepository;
    private $providerProductRepository;
    private $ordersRepository;
    private $ordersProductRepository;
    private $economiaRepository;
    private $userRepository;
    private $almacenRepository;

    public function __construct(AlmacenRepository $almacenRepository, UserRepository $userRepository, EconomiaRepository $economiaRepository, OrdersProductsRepository $ordersProductRepository, KeyController $keyController, OrdersRepository $ordersRepository, ProviderProductRepository $providerProductRepository, ProviderRepository $providerRepository, ProductsRepository $productsRepository)
    {
        $this->productsRepository = $productsRepository;
        $this->keyController = $keyController;
        $this->providerRepository = $providerRepository;
        $this->providerProductRepository = $providerProductRepository;
        $this->ordersRepository = $ordersRepository;
        $this->ordersProductRepository = $ordersProductRepository;
        $this->economiaRepository = $economiaRepository;
        $this->userRepository = $userRepository;
        $this->almacenRepository = $almacenRepository;
    }

    #[Route('/', name: 'app_almacen_index', methods: ['GET'])]
    public function index(AlmacenRepository $almacenRepository): Response
    {
        $user = $this->userRepository->findOneBy(['email' => $this->getUser()->getUserIdentifier()]);
        $roles = $user->getRoles();
        if (in_array("ROLE_ALMACEN", $user->getRoles())) {
            return $this->render('almacen/index.html.twig', [
                'almacen' => $almacenRepository->findAll(),
            ]);
        } else {

            return $this->render('error/index.html.twig');
        }
    }
}