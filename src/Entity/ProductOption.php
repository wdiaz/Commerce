<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Repository\ProductOptionRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ProductOptionRepository::class)]
#[ApiResource]
class ProductOption
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column(length: 255)]
    private ?string $optionType = null;

    #[ORM\Column(length: 255)]
    private ?string $attributeName = null;

    #[ORM\Column(length: 255)]
    private ?string $label = null;

    #[ORM\Column]
    private ?bool $isRequired = true;

    #[ORM\Column]
    private ?int $displayOrder = null;

    /**
     * @var Collection<int, Product>
     */
    #[ORM\ManyToMany(targetEntity: Product::class, mappedBy: 'productOptions', orphanRemoval: true)]
    private Collection $products;

    /**
     * @var Collection<int, ProductOptionValue>
     */
    #[ORM\OneToMany(mappedBy: 'productOption', targetEntity: ProductOptionValue::class, cascade: ['persist'])]
    private Collection $productOptionValues;

    /**
     * @var Collection<int, ProductVariantOption>
     */
    #[ORM\OneToMany(mappedBy: 'productOption', targetEntity: ProductVariantOption::class)]
    private Collection $productVariantOptions;

    public function __construct()
    {
        $this->products = new ArrayCollection();
        $this->productOptionValues = new ArrayCollection();
        $this->productVariantOptions = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    public function getOptionType(): ?string
    {
        return $this->optionType;
    }

    public function setOptionType(string $optionType): static
    {
        $this->optionType = $optionType;

        return $this;
    }

    public function getAttributeName(): ?string
    {
        return $this->attributeName;
    }

    public function setAttributeName(string $attributeName): static
    {
        $this->attributeName = $attributeName;

        return $this;
    }

    public function getLabel(): ?string
    {
        return $this->label;
    }

    public function setLabel(string $label): static
    {
        $this->label = $label;

        return $this;
    }

    public function isRequired(bool $flag = false): ?bool
    {
        return $this->isRequired;
    }

    public function setRequired(bool $isRequired): static
    {
        $this->isRequired = $isRequired;

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

    /**
     * @return Collection<int, Product>
     */
    public function getProducts(): Collection
    {
        return $this->products;
    }

    public function addProduct(Product $product): static
    {
        if (!$this->products->contains($product)) {
            $this->products->add($product);
            $product->addProductOption($this);
        }

        return $this;
    }

    public function removeProduct(Product $product): static
    {
        if ($this->products->removeElement($product)) {
            $product->removeProductOption($this);
        }

        return $this;
    }

    /**
     * @return Collection<int, ProductOptionValue>
     */
    public function getProductOptionValues(): Collection
    {
        return $this->productOptionValues;
    }

    public function addProductOptionValue(ProductOptionValue $productOptionValue): static
    {
        if (!$this->productOptionValues->contains($productOptionValue)) {
            $this->productOptionValues->add($productOptionValue);
            $productOptionValue->setProductOption($this);
        }

        return $this;
    }

    public function removeProductOptionValue(ProductOptionValue $productOptionValue): static
    {
        if ($this->productOptionValues->removeElement($productOptionValue)) {
            // set the owning side to null (unless already changed)
            if ($productOptionValue->getProductOption() === $this) {
                $productOptionValue->setProductOption(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, ProductVariantOption>
     */
    public function getProductVariantOptions(): Collection
    {
        return $this->productVariantOptions;
    }

    public function addProductVariantOption(ProductVariantOption $productVariantOption): static
    {
        if (!$this->productVariantOptions->contains($productVariantOption)) {
            $this->productVariantOptions->add($productVariantOption);
            $productVariantOption->setProductOption($this);
        }

        return $this;
    }

    public function removeProductVariantOption(ProductVariantOption $productVariantOption): static
    {
        if ($this->productVariantOptions->removeElement($productVariantOption)) {
            // set the owning side to null (unless already changed)
            if ($productVariantOption->getProductOption() === $this) {
                $productVariantOption->setProductOption(null);
            }
        }

        return $this;
    }
}
