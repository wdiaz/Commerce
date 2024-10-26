<?php

namespace App\Controller;

use App\Entity\Cart;
use App\Entity\Product;
use App\Form\CartType;
use App\Repository\CartRepository;
use App\Service\CartService;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/cart')]
class CartController extends AbstractController
{
    public function __construct(
        private readonly EntityManagerInterface $entityManager,
    ) {
    }

    #[Route('/', name: 'app_cart_index', methods: ['GET'])]
    public function index(Request $request, CartRepository $cartRepository): Response
    {
        /**
         * @TODO: Remove the line below
         * For testing and developing purposes the line below is hardcoded.
         */
        //$uuid = 'daf04ddb-a66a-4c54-bbe9-e88b2903e30d';
        $cartId = $request->getSession()->get('cart_id');

        $cart = $cartRepository->findOneBy([
            'uuid' => $cartId,
        ]);

        return $this->render('cart/index.html.twig', [
            'cart' => $cart,
        ]);
    }

    #[Route('/{id}/add-item', name: 'app_cart_add_item', methods: ['GET'])]
    public function addItemToCart(
        Request $request,
        CartService $cartService,
        Product $product,
    ): Response {
        $cartId = $request->getSession()->get('cart_id');

        $cart = $cartService->addItemToCart($cartId, $product, 7);

        return $this->redirectToRoute('app_cart_index', [], Response::HTTP_SEE_OTHER);
    }

    #[Route('/new', name: 'app_cart_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $cart = new Cart();
        $form = $this->createForm(CartType::class, $cart);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($cart);
            $entityManager->flush();

            return $this->redirectToRoute('app_cart_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('cart/new.html.twig', [
            'cart' => $cart,
            'form' => $form->createView(),
        ]);
    }

    #[Route('/{id}', name: 'app_cart_show', methods: ['GET'])]
    public function show(Cart $cart): Response
    {
        return $this->render('cart/show.html.twig', [
            'cart' => $cart,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_cart_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Cart $cart, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(CartType::class, $cart);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_cart_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('cart/edit.html.twig', [
            'cart' => $cart,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_cart_delete', methods: ['POST'])]
    public function delete(Request $request, Cart $cart, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$cart->getId(), $request->getPayload()->get('_token'))) {
            $entityManager->remove($cart);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_cart_index', [], Response::HTTP_SEE_OTHER);
    }
}
