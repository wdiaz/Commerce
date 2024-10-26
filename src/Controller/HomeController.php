<?php

namespace App\Controller;

use App\Repository\ProductRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\UX\Chartjs\Builder\ChartBuilderInterface;

class HomeController extends AbstractController
{
    #[Route('/', name: 'app_home')]
    public function index(ProductRepository $productRepository, ChartBuilderInterface $chartBuilder): Response
    {
        return $this->render('home/index.html.twig', [
            'products' => $productRepository->findAll(),
            'hotProducts' => $productRepository->findBy([], ['id' => 'DESC'], 4),
        ]);
    }
}
