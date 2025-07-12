<?php

namespace App\ApiResource;

use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\Patch;
use ApiPlatform\Metadata\Post;
use App\State\AddProductToCartProcessor;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ApiResource(
    shortName: 'Add Product to Cart',
    operations: [
        new Patch(),
        new Post(),
    ],
    processor: AddProductToCartProcessor::class
)]
class AddToCart
{
    #[Assert\NotBlank]
    public string $sku;

    #[Assert\NotBlank]
    #[Assert\Uuid]
    public string $merchantUuId;

    #[Assert\Length(min: 1, max: 255)]
    public string $sessionId;

    #[Assert\Uuid]
    public string $uuid;

    #[Assert\NotBlank()]
    #[Assert\Positive]
    public int $quantity;

    public function getQuantity(): int
    {
        return $this->quantity;
    }

    public function getSessionId(): ?string
    {
        return $this->sessionId;
    }

    public function getProductSku(): string
    {
        return $this->sku;
    }

    /**
     * @return string
     */
    public function getMerchantUuid(): string
    {
        return $this->merchantUuId;
    }

    public function getUuid(): string
    {
        return $this->uuid;
    }

}
