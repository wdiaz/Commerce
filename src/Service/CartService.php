<?php

namespace App\Service;

use App\Entity\Cart;
use App\Entity\CartItem;
use App\Entity\Product;
use App\Exceptions\ProductNotFoundException;
use App\Repository\CartRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\Exception\ORMException;
use Doctrine\ORM\OptimisticLockException;

readonly class CartService
{
    public function __construct(
        private EntityManagerInterface $entityManager,
        private CartRepository $cartRepository,
    ) {
    }

    /**
     * Adds an item to a cart, creating the cart if it does not exist.
     *
     * @throws ProductNotFoundException if the product is invalid or not found
     * @throws ORMException             if a database error occurs
     * @throws OptimisticLockException  if a concurrency issue occurs
     */
    public function addItemToCart(string $cartId, Product $product, int $quantity = 1): Cart
    {
        // Validate product and price
        if (!$product || !$product->getId()) {
            throw new ProductNotFoundException('Invalid product provided.');
        }

        if (!is_numeric($product->getPrice()) || $product->getPrice() < 0) {
            throw new \InvalidArgumentException('Product price must be a valid non-negative number.');
        }

        // Start a transaction to handle concurrency
        $this->entityManager->beginTransaction();

        try {
            // Find or create the cart
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

            // Find or create the cart item
            $cartItem = $this->findOrCreateCartItem($cart, $product);
            $cartItem->setQuantity($cartItem->getQuantity() + $quantity);
            $cartItem->setPrice((float) $product->getPrice());

            $this->entityManager->persist($cartItem);
            $this->entityManager->flush();

            // Commit the transaction
            $this->entityManager->commit();

            return $cart;
        } catch (\Exception $e) {
            // Rollback the transaction on error
            $this->entityManager->rollback();
            throw $e;
        }
    }

    /**
     * Finds an existing cart item for the product or creates a new one.
     *
     * @throws ORMException if a database error occurs
     */
    private function findOrCreateCartItem(Cart $cart, Product $product): CartItem
    {
        // Use a more efficient lookup mechanism (e.g., indexed collection)
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
