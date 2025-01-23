<?php

declare(strict_types=1);

namespace App\Twig\Extension;

use App\Entity\ProductInterface;
use App\Entity\ProductVariant;
use Twig\Extension\AbstractExtension;
use Twig\TwigFunction;

/**
 * Determines it a product is a variant.
 */
class ProductTypeResolver extends AbstractExtension
{
    /**
     * @return TwigFunction[]
     */
    public function getFunctions(): array
    {
        return [
            new TwigFunction('is_variant', [$this, 'isVariant']),
        ];
    }

    /**
     * @param ProductInterface $product
     * @return bool
     */
    public function isVariant(ProductInterface $product): bool
    {
        return $product instanceof ProductVariant/* || $product->getProduct() !== null; */
        ;
    }
}
