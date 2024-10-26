<?php

namespace App\Service;

use App\Entity\Cart;
use App\Entity\CartItem;
use App\Entity\Product;
use App\Exceptions\ProductNotFoundException;
use App\Repository\CartRepository;
use Doctrine\ORM\EntityManagerInterface;

class CartService
{
    public function __construct(
        private readonly EntityManagerInterface $entityManager,
        private readonly CartRepository $cartRepository,
    ) {
    }

    /**
     * Adds an item to a cart, creating the cart if it does not exist.
     */
    public function addItemToCart(string $cartId, Product $product, int $quantity = 1): Cart
    {
        $cart = $this->cartRepository->findOneBy(
            [
                'uuid' => $cartId,
                'status' => Cart::ACTIVE,
            ]
        ) ?? new Cart();

        if (!$cart->getId()) {
            $cart->setUuid($cartId);
            $this->entityManager->persist($cart);
        }

        $cartItem = $this->findOrCreateCartItem($cart, $product);
        $cartItem->setQuantity($cartItem->getQuantity() + $quantity);

        $cartItem->setPrice((float) $product->getPrice());
        $this->entityManager->persist($cartItem);
        $this->entityManager->flush();

        return $cart;
    }

    /**
     * Finds an existing cart item for the product or creates a new one.
     */
    private function findOrCreateCartItem(Cart $cart, Product $product): CartItem
    {
        $cartItem = $cart->getCartItems()->filter(
            fn ($item) => $item->getProduct()->getId() === $product->getId()
        )->first();

        if (!$cartItem) {
            $cartItem = new CartItem();
            $cartItem->setCart($cart);
            $cartItem->setProduct($product);
            $cart->addCartItem($cartItem);
        }

        return $cartItem;
    }
}
