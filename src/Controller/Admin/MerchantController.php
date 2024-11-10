<?php

namespace App\Controller\Admin;

use App\Entity\Merchant;
use App\Form\MerchantType;
use App\Repository\MerchantRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/admin/merchant')]
class MerchantController extends AbstractController
{
    #[Route('/', name: 'app_admin_merchant_index', methods: ['GET'])]
    public function index(MerchantRepository $merchantRepository): Response
    {
        return $this->render('admin/merchant/index.html.twig', [
            'merchants' => $merchantRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_admin_merchant_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $merchant = new Merchant();
        $form = $this->createForm(MerchantType::class, $merchant);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($merchant);
            $entityManager->flush();

            return $this->redirectToRoute('app_admin_merchant_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('admin/merchant/new.html.twig', [
            'merchant' => $merchant,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_admin_merchant_show', methods: ['GET'])]
    public function show(Merchant $merchant): Response
    {
        return $this->render('admin/merchant/show.html.twig', [
            'merchant' => $merchant,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_admin_merchant_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Merchant $merchant, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(MerchantType::class, $merchant);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_admin_merchant_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('admin/merchant/edit.html.twig', [
            'merchant' => $merchant,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_admin_merchant_delete', methods: ['POST'])]
    public function delete(Request $request, Merchant $merchant, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$merchant->getId(), $request->getPayload()->get('_token'))) {
            $entityManager->remove($merchant);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_admin_merchant_index', [], Response::HTTP_SEE_OTHER);
    }
}
