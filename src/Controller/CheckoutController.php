<?php

namespace App\Controller;

use App\Repository\CartRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class CheckoutController extends AbstractController
{
    #[Route('/checkout', name: 'app_checkout')]
    public function index(Request $request, CartRepository $cartRepository): Response
    {
        $cartId = $request->getSession()->get('cart_id');
        $cart = $cartRepository->findOneBy([
            'uuid' => $cartId,
        ]);
        $isCartEmpty = null === $cart || null === $cart->getCartItems();

        return $this->render('checkout/index.html.twig', [
            'controller_name' => 'CheckoutController',
            'cart' => $cart,
            'isCartEmpty' => $isCartEmpty,
        ]);
    }
}
