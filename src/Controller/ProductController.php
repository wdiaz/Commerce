<?php

namespace App\Controller;

use App\Entity\Product;
use App\Form\ProductActionType;
use App\Form\VariantOptionType;
use App\Service\SkuSearchService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/p')]
class ProductController extends AbstractController
{
    #[Route('/{id}/{slug}', name: 'app_product_show', methods: ['GET', 'POST'])]
    public function show(Product $product): Response
    {

        $productActionForm = $this->createForm(ProductActionType::class);
        // Example product data with multiple options
        $productOptions = [
            'shoeSize' => ['5' => '5', '5.5' => '5.5', '6' => '6', '6.5' => '6.5', '7' => '7'],
            'color' => ['Red' => 'red', 'Blue' => 'blue', 'Green' => 'green'],
        ];

        // Pass product options dynamically
        $optionForm = $this->createForm(VariantOptionType::class, null, [
            'productOptions' => $productOptions,
        ]);

        return $this->render('product/show.html.twig', [
            'product' => $product,
            'form' => $productActionForm->createView(),
            'optionForm' => $optionForm->createView(),
        ]);
    }

    #[Route('/{sku}', name: 'app_product_show_by_sku', methods: ['GET', 'POST'])]
    public function showBySku(string $sku, SkuSearchService $searchService): Response
    {
        $product = $searchService->findBySku($sku);

        dump($product);

        exit;
    }
}
