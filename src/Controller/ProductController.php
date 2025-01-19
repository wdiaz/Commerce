<?php

namespace App\Controller;

use App\Entity\Product;
use App\Form\SizeSelectorType;
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

        $sizeOption = $product->getProductOptions()->filter(function ($option) {
            if ('Size' == $option->getAttributeName()) {
                return true;
            }

            return false;
        })->first();

        $productActionForm = $this->createForm(SizeSelectorType::class, null, [
            'sizes' => $sizeOption->getProductOptionValues()->toArray(),
        ]);

        return $this->render('product/show.html.twig', [
            'product' => $product,
            'form' => $productActionForm->createView(),
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
