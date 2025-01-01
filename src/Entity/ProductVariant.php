<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Repository\VariantRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: VariantRepository::class)]
#[ApiResource]
class ProductVariant
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'variants', targetEntity: Product::class)]
    #[ORM\JoinColumn(nullable: false)]
    private ?Product $product = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $createdAt = null;

    #[ORM\Column(nullable: true)]
    private ?\DateTimeImmutable $updatedAt = null;

    #[ORM\Column(length: 255)]
    private ?string $sku = null;

    #[ORM\Column(length: 255)]
    private ?string $mainImage = null;

    /**
     * @var Collection<int, ProductVariantOption>
     */
    #[ORM\OneToMany(mappedBy: 'productVariant', targetEntity: ProductVariantOption::class)]
    private Collection $productVariantOptions;

    public function __construct()
    {
        $this->productVariantOptions = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getProduct(): ?Product
    {
        return $this->product;
    }

    public function setProduct(?Product $product): static
    {
        $this->product = $product;

        return $this;
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

    public function getSku(): ?string
    {
        return $this->sku;
    }

    public function setSku(string $sku): static
    {
        $this->sku = $sku;

        return $this;
    }

    public function getMainImage(): ?string
    {
        return $this->mainImage;
    }

    public function setMainImage(string $mainImage): static
    {
        $this->mainImage = $mainImage;

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
            $productVariantOption->setProductVariant($this);
        }

        return $this;
    }

    public function removeProductVariantOption(ProductVariantOption $productVariantOption): static
    {
        if ($this->productVariantOptions->removeElement($productVariantOption)) {
            // set the owning side to null (unless already changed)
            if ($productVariantOption->getProductVariant() === $this) {
                $productVariantOption->setProductVariant(null);
            }
        }

        return $this;
    }
}
