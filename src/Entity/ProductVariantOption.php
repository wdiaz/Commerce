<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Repository\ProductVariantOptionRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ProductVariantOptionRepository::class)]
#[ApiResource]
class ProductVariantOption
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $createdAt = null;

    #[ORM\Column(nullable: true)]
    private ?\DateTimeImmutable $updatedAt = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column(length: 255)]
    private ?string $optionType = null;

    #[ORM\ManyToOne(inversedBy: 'productVariantOptions')]
    private ?ProductVariant $productVariant = null;

    #[ORM\Column]
    private ?bool $isRequired = null;

    #[ORM\Column(nullable: true)]
    private ?int $displayOrder = null;

    /**
     * @var Collection<int, ProductVariantOptionValues>
     */
    #[ORM\OneToMany(mappedBy: 'productVariantOption', targetEntity: ProductVariantOptionValues::class)]
    private Collection $productVariantOptionValues;

    public function __construct()
    {
        $this->productVariantOptionValues = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCreatedAt(): ?\DateTimeImmutable
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeImmutable $createdAt): static
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getUpdatedAt(): ?\DateTimeImmutable
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(?\DateTimeImmutable $updatedAt): static
    {
        $this->updatedAt = $updatedAt;

        return $this;
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

    public function getProductVariant(): ?ProductVariant
    {
        return $this->productVariant;
    }

    public function setProductVariant(?ProductVariant $productVariant): static
    {
        $this->productVariant = $productVariant;

        return $this;
    }

    public function isRequired(): ?bool
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

    public function setDisplayOrder(?int $displayOrder): static
    {
        $this->displayOrder = $displayOrder;

        return $this;
    }

    /**
     * @return Collection<int, ProductVariantOptionValues>
     */
    public function getProductVariantOptionValues(): Collection
    {
        return $this->productVariantOptionValues;
    }

    public function addProductVariantOptionValue(ProductVariantOptionValues $productVariantOptionValue): static
    {
        if (!$this->productVariantOptionValues->contains($productVariantOptionValue)) {
            $this->productVariantOptionValues->add($productVariantOptionValue);
            $productVariantOptionValue->setProductVariantOption($this);
        }

        return $this;
    }

    public function removeProductVariantOptionValue(ProductVariantOptionValues $productVariantOptionValue): static
    {
        if ($this->productVariantOptionValues->removeElement($productVariantOptionValue)) {
            // set the owning side to null (unless already changed)
            if ($productVariantOptionValue->getProductVariantOption() === $this) {
                $productVariantOptionValue->setProductVariantOption(null);
            }
        }

        return $this;
    }
}
