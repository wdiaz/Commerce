<?php

namespace App\Controller;

use App\Entity\Merchant;
use App\Repository\ProductRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/store')]
class StoreController extends AbstractController
{
    #[Route('/', name: 'app_store_index', methods: ['GET'])]
    public function index(): Response
    {
        return $this->render('store/index.html.twig', [
            'controller_name' => 'StoreController',
        ]);
    }

    #[Route('/{slug}', name: 'app_store_view', methods: ['GET'])]
    public function view(Merchant $merchant, ProductRepository $productRepository): Response
    {
        $products = $productRepository->findBy(['merchant' => $merchant]);
        return $this->render('store/index.html.twig', [
            'controller_name' => 'StoreController',
            'products' => $products,
            'merchant' => $merchant,
        ]);
    }
}
