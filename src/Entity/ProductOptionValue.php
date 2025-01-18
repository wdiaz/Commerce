<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Repository\ProductOptionValueRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ProductOptionValueRepository::class)]
#[ApiResource]
class ProductOptionValue
{
    #[ORM\Id]
    #[ORM\GeneratedValue(strategy: 'AUTO')]
    #[ORM\Column(type: 'integer')]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $attributeValue = null;

    #[ORM\Column]
    private ?int $displayOrder = null;

    #[ORM\ManyToOne(inversedBy: 'productOptionValues')]
    private ?ProductOption $productOption = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getAttributeValue(): ?string
    {
        return $this->attributeValue;
    }

    public function setAttributeValue(string $attributeValue): static
    {
        $this->attributeValue = $attributeValue;

        return $this;
    }

    public function getDisplayOrder(): ?int
    {
        return $this->displayOrder;
    }

    public function setDisplayOrder(int $displayOrder): static
    {
        $this->displayOrder = $displayOrder;

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
}
