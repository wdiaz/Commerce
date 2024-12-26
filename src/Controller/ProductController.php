<?php

namespace App\Controller;

use App\Entity\Product;
use App\Form\ProductActionType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/product')]
class ProductController extends AbstractController
{
    #[Route('/{id}/{slug}', name: 'app_product_show', methods: ['GET', 'POST'])]
    public function show(Product $product): Response
    {
        $productActionForm = $this->createForm(ProductActionType::class);

        return $this->render('product/show.html.twig', [
            'product' => $product,
            'form' => $productActionForm->createView(),
        ]);
    }
}
