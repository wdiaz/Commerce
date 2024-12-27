<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Repository\ProductOptionValuesRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ProductOptionValuesRepository::class)]
#[ApiResource]
class ProductOptionValues
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $value = null;

    #[ORM\ManyToOne(inversedBy: 'productOptionValues')]
    #[ORM\JoinColumn(nullable: false)]
    private ?ProductOption $ProductOption = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getValue(): ?string
    {
        return $this->value;
    }

    public function setValue(string $value): static
    {
        $this->value = $value;

        return $this;
    }

    public function getProductOption(): ?ProductOption
    {
        return $this->ProductOption;
    }

    public function setProductOption(?ProductOption $ProductOption): static
    {
        $this->ProductOption = $ProductOption;

        return $this;
    }
}
