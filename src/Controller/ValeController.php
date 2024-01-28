<?php

namespace App\Controller;

use App\Entity\Almacen;
use App\Entity\Vale;
use App\Form\ValeType;
use App\Controller\AlmacenController;
use App\Repository\ValeRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/web/vale')]
class ValeController extends AbstractController

{
    private $almacenControler;
    public function __construct( AlmacenController $almacenController)
{
  $this->almacenControler=$almacenController;
}

    #[Route('/', name: 'app_vale_index', methods: ['GET'])]
    public function index(ValeRepository $valeRepository): Response
    {
       
        return $this->render('vale/index.html.twig', [
            'vales' => $valeRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_vale_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $vale = new Vale();
        $form = $this->createForm(ValeType::class, $vale);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($vale);
            $entityManager->flush();

            return $this->redirectToRoute('app_vale_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('vale/new.html.twig', [
            'vale' => $vale,
            'form' => $form,
        ]);
    }

    #[Route('/{id}/newIn', name: 'app_vale_new_in', methods: ['GET', 'POST'])]
    public function newIn(Request $request, Almacen $almacen, EntityManagerInterface $entityManager): Response
    {
        $vale = new Vale();
        $form = $this->createForm(ValeType::class, $vale);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $vale->setIdAlmacen($almacen->getId());
            $vale->setRecpDesp($this->getUser()->getUserIdentifier());
            $vale->setTipo("Entrada");
            $entityManager->persist($vale);
            $entityManager->flush();

            return $this->redirectToRoute('app_almacen_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('vale/new.html.twig', [
            'vale' => $vale,
            'form' => $form,
        ]);
    }

    #[Route('/{id}/newOut', name: 'app_vale_new_out', methods: ['GET', 'POST'])]
    public function newOut(Request $request, Almacen $almacen, EntityManagerInterface $entityManager): Response
    {
        $vale = new Vale();
        $form = $this->createForm(ValeType::class, $vale);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $vale->setIdAlmacen($almacen->getId());
            $vale->setRecpDesp($this->getUser()->getUserIdentifier());
            $vale->setTipo("Salida");
            $entityManager->persist($vale);
            $entityManager->flush();

            return $this->redirectToRoute('app_almacen_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('vale/new.html.twig', [
            'vale' => $vale,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_vale_show', methods: ['GET'])]
    public function show(Vale $vale): Response
    {
        return $this->render('vale/show.html.twig', [
            'vale' => $vale,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_vale_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Vale $vale, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(ValeType::class, $vale);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_vale_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('vale/edit.html.twig', [
            'vale' => $vale,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_vale_delete', methods: ['POST'])]
    public function delete(Request $request, Vale $vale, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$vale->getId(), $request->request->get('_token'))) {
            $entityManager->remove($vale);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_vale_index', [], Response::HTTP_SEE_OTHER);
    }
}
