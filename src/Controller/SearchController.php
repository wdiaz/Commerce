<?php

namespace App\Controller;

use App\Repository\ProductRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class SearchController extends AbstractController
{
    #[Route('/s', name: 'app_search')]
    public function index(Request $request, ProductRepository $productRepository): Response
    {
        $query = $request->query->get('query');
        $products = $productRepository->searchProducts($query);



        return $this->render('search/index.html.twig', [
            'controller_name' => 'SearchController',
            'query' => $query,
            'products' => $products,
        ]);
    }
}
