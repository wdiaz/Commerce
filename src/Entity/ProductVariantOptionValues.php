<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Repository\ProductVariantOptionValuesRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ProductVariantOptionValuesRepository::class)]
#[ApiResource]
class ProductVariantOptionValues
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'productVariantOptionValues')]
    private ?ProductVariantOption $productVariantOption = null;

    #[ORM\Column(length: 255)]
    private ?string $optionValue = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getProductVariantOption(): ?ProductVariantOption
    {
        return $this->productVariantOption;
    }

    public function setProductVariantOption(?ProductVariantOption $productVariantOption): static
    {
        $this->productVariantOption = $productVariantOption;

        return $this;
    }

    public function getOptionValue(): ?string
    {
        return $this->optionValue;
    }

    public function setOptionValue(string $optionValue): static
    {
        $this->optionValue = $optionValue;

        return $this;
    }
}
