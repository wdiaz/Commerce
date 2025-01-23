<?php

namespace App\Controller\Admin;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/admin')]
final class SearchController extends AbstractController
{
    #[Route('/search', name: 'app_admin_search')]
    public function index(): Response
    {
        return $this->render('admin/search/index.html.twig', [
            'controller_name' => 'SearchController',
        ]);
    }
}
