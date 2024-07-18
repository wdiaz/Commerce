<?php

namespace App\State;

use ApiPlatform\Metadata\Operation;
use ApiPlatform\State\ProcessorInterface;
use App\Entity\Cart;
use App\Entity\CartItem;
use App\Exceptions\MerchantNotFoundException;
use App\Exceptions\ProductNotFoundException;
use App\Repository\CartRepository;
use App\Repository\MerchantRepository;
use App\Repository\ProductRepository;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Psr\Log\LoggerInterface;

/**
 *  Add products to Cart.
 *
 * @TODO: Refactor this class and use best practices.
 * Right now it's a placeholder that allows me to unlock other features.
 * Consequently, this class is not ready for production.
 */
final class AddProductToCartProcessor implements ProcessorInterface
{
    public function __construct(
        private EntityManagerInterface $entityManager,
        private ProductRepository $productRepository,
        private CartRepository $cartRepository,
        private MerchantRepository $merchantRepository,
        private UserRepository $userRepository,
        private LoggerInterface $logger,
    ) {
    }

    /**
     * @throws ProductNotFoundException|MerchantNotFoundException
     */
    public function process(mixed $data, Operation $operation, array $uriVariables = [], array $context = []): Cart
    {
        // Placeholder for now
        $price = 34.44;

        if (
            $cart = $this->cartRepository->findOneBy([
                'session' => $data->getSessionId(),
                'status' => Cart::ACTIVE,
            ])
        ) {
            $product = $this->productRepository->findOneBy([
                'sku' => $data->getProductSku(),
            ]);

            if (null === $product) {
                throw new ProductNotFoundException(sprintf("Product with sku '%s' not found.", $data->getProductId()));
            }

            $merchant = $this->merchantRepository->findOneBy(['uuid' => $data->getMerchantUuid()]);

            if (null === $merchant) {
                throw new MerchantNotFoundException(sprintf("Merchant '%s' not found.", $data->getMerchantUuid()));
            }

            $productExist = false;
            $cartItem = null;
            /*
             * I dont like this loop
             */
            foreach ($cart->getCartItems() as $item) {
                if ($item->getProduct()->getId() === $product->getId()) {
                    $productExist = true;
                    $cartItem = $item;
                    break;
                }
            }

            if (false === $productExist) {
                $cartItem = new CartItem();
                $cartItem->setProduct($product);
                $cartItem->setQuantity($data->getQuantity() + $cartItem->getQuantity());
                $cartItem->setPrice($price);
                $cartItem->setCart($cart);
                $cart->addCartItem($cartItem);
            } else {
                $cartItem->setQuantity($data->getQuantity() + $cartItem->getQuantity());
            }
            $this->entityManager->persist($cart);
            $this->entityManager->flush();
        } elseif (
            $cart = $this->cartRepository->findOneBy([
                'uuid' => $data->getUuid(),
                'status' => Cart::ACTIVE,
            ])
        ) {
            dump(sprintf('Cart UUID %s is already active', $data->getUuid()));
        } else {
            // Cart does not exist. Create a new one.

            $cart = new Cart();
            $cart->setStatus(Cart::ACTIVE);

            $cart->setUuid($data->getUuid());
            $cart->setSession($data->getSessionId());

            $product = $this->productRepository->findOneBy([
                'sku' => $data->getProductSku(),
            ]);

            if (null === $product) {
                throw new ProductNotFoundException(sprintf("Product with sku '%s' not found.", $data->getProductId()));
            }

            $merchant = $this->merchantRepository->findOneBy(['uuid' => $data->getMerchantUuid()]);

            if (null === $merchant) {
                throw new MerchantNotFoundException(sprintf("Merchant '%s' not found.", $data->getMerchantUuid()));
            }

            $cartItem = new CartItem();
            $cartItem->setProduct($product);
            $cartItem->setQuantity($data->getQuantity());
            $cartItem->setPrice($price);
            $cart->addCartItem($cartItem);
            $cartItem->setCart($cart);

            $this->entityManager->persist($cart);
            $this->entityManager->flush();
            $this->logger->info(sprintf('Cart UUID %s is active', $data->getUuid()));
        }

        return $cart;
    }
}
