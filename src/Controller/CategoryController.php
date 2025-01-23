<?php

namespace App\Controller;

use App\Entity\Category;
use App\Repository\CategoryRepository;
use App\Repository\ProductRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/c')]
class CategoryController extends AbstractController
{
    #[Route('/', name: 'app_category_index', methods: ['GET'])]
    public function index(CategoryRepository $categoryRepository): Response
    {
        return $this->render('category/index.html.twig', [
            'categories' => $categoryRepository->findAll(),
        ]);
    }

    #[Route('/{slug}', name: 'app_category_show_products', methods: ['GET'])]
    public function showProducts(
        ProductRepository $productRepository,
        CategoryRepository $categoryRepository,
        string $slug,
    ): Response {
        $category = $categoryRepository->findOneBy(['slug' => $slug]);
        /**
         * @TODO: get products is not efficient.
         */
        $products = $category->getProducts();

        return $this->render('category/products.html.twig', [
            'category' => $category,
            'products' => $products,
        ]);
    }

    #[Route('/{slug}', name: 'app_category_show', methods: ['GET'])]
    public function show(Category $category): Response
    {
        return $this->render('admin/category/show.html.twig', [
            'category' => $category,
        ]);
    }


}
