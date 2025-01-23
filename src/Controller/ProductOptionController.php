<?php

namespace App\Controller;

use App\Entity\ProductOption;
use App\Form\ProductOptionType;
use App\Repository\ProductOptionRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/product/option')]
final class ProductOptionController extends AbstractController
{
    #[Route(name: 'app_product_option_index', methods: ['GET'])]
    public function index(ProductOptionRepository $productOptionRepository): Response
    {
        return $this->render('product_option/index.html.twig', [
            'product_options' => $productOptionRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_product_option_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $productOption = new ProductOption();
        $form = $this->createForm(ProductOptionType::class, $productOption);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($productOption);
            $entityManager->flush();

            return $this->redirectToRoute('app_product_option_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('product_option/new.html.twig', [
            'product_option' => $productOption,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_product_option_show', methods: ['GET'])]
    public function show(ProductOption $productOption): Response
    {
        return $this->render('product_option/show.html.twig', [
            'product_option' => $productOption,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_product_option_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, ProductOption $productOption, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(ProductOptionType::class, $productOption);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_product_option_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('product_option/edit.html.twig', [
            'product_option' => $productOption,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_product_option_delete', methods: ['POST'])]
    public function delete(Request $request, ProductOption $productOption, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$productOption->getId(), $request->getPayload()->getString('_token'))) {
            $entityManager->remove($productOption);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_product_option_index', [], Response::HTTP_SEE_OTHER);
    }
}
