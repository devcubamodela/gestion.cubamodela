<?php

namespace App\Controller;

use App\Entity\Almacen;
use App\Form\AlmacenType;
use App\Repository\AlmacenRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Controller\ValeController;
use App\Repository\ValeRepository;

#[Route('/web/almacen')]
class AlmacenController extends AbstractController
{
    #[Route('/', name: 'app_almacen_index', methods: ['GET'])]
    public function index(AlmacenRepository $almacenRepository): Response
    {
        return $this->render('almacen/index.html.twig', [
            'almacens' => $almacenRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_almacen_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $almacen = new Almacen();
        $form = $this->createForm(AlmacenType::class, $almacen);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($almacen);
            $entityManager->flush();

            return $this->redirectToRoute('app_almacen_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('almacen/new.html.twig', [
            'almacen' => $almacen,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_almacen_show', methods: ['GET'])]
    public function show(Almacen $almacen, ValeRepository $valeRepository): Response
    {
        return $this->render('almacen/show.html.twig', [
            'almacen' => $almacen,
            'vales' => $valeRepository->findAll(),
        ]);
    }

    #[Route('/{id}/edit', name: 'app_almacen_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Almacen $almacen, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(AlmacenType::class, $almacen);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_almacen_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('almacen/edit.html.twig', [
            'almacen' => $almacen,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_almacen_delete', methods: ['POST'])]
    public function delete(Request $request, Almacen $almacen, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$almacen->getId(), $request->request->get('_token'))) {
            $entityManager->remove($almacen);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_almacen_index', [], Response::HTTP_SEE_OTHER);
    }
}
