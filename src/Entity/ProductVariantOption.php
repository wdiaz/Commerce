<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Repository\ProductVariantOptionRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ProductVariantOptionRepository::class)]
#[ApiResource]
class ProductVariantOption
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'productVariantOptions')]
    private ?ProductVariant $productVariant = null;

    #[ORM\ManyToOne(inversedBy: 'productVariantOptions')]
    private ?ProductOption $productOption = null;

    #[ORM\ManyToOne(inversedBy: 'productVariantOptions')]
    private ?ProductOptionValue $productOptionValue = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getProductVariant(): ?ProductVariant
    {
        return $this->productVariant;
    }

    public function setProductVariant(?ProductVariant $productVariant): static
    {
        $this->productVariant = $productVariant;

        return $this;
    }

    public function getProductOption(): ?ProductOption
    {
        return $this->productOption;
    }

    public function setProductOption(?ProductOption $productOption): static
    {
        $this->productOption = $productOption;

        return $this;
    }

    public function getProductOptionValue(): ?ProductOptionValue
    {
        return $this->productOptionValue;
    }

    public function setProductOptionValue(?ProductOptionValue $productOptionValue): static
    {
        $this->productOptionValue = $productOptionValue;

        return $this;
    }
}
