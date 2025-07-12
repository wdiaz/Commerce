<?php

namespace App\Service;

use App\Entity\Product;
//use App\Entity\ProductVariant;
use App\Repository\ProductRepository;
//use App\Repository\VariantRepository;
use Doctrine\ORM\NonUniqueResultException;

class SkuSearchService
{
    private ProductRepository $productRepository;
    //private VariantRepository $variantRepository;

    public function __construct(ProductRepository $productRepository/*, VariantRepository $variantRepository*/)
    {
        $this->productRepository = $productRepository;
        //$this->variantRepository = $variantRepository;
    }

    /**
     * Search for a SKU in products and variants.
     * @throws NonUniqueResultException
     */
    public function findBySku(string $sku): Product|/*ProductVariant|*/null
    {
        $product = $this->productRepository->findBySku($sku);
        if ($product) {
            return $product;
        }

/*        $variant = $this->variantRepository->findBySku($sku);
        if ($variant) {
            return $variant;
        }*/

        return null;
    }
}
