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

    #[ORM\ManyToOne(targetEntity: ProductVariant::class, inversedBy: 'productVariantOptions')]
    #[ORM\JoinColumn(name: 'product_variant_id', referencedColumnName: 'id')]
    private ?ProductVariant $productVariant = null;

    #[ORM\ManyToOne(targetEntity: ProductOption::class, inversedBy: 'productVariantOptions')]
    #[ORM\JoinColumn(name: 'product_option_id', referencedColumnName: 'id')]
    private ?ProductOption $productOption = null;

    #[ORM\ManyToOne(targetEntity: ProductOptionValue::class, inversedBy: 'productVariantOptions')]
    #[ORM\JoinColumn(name: 'product_option_value_id', referencedColumnName: 'id')]
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
