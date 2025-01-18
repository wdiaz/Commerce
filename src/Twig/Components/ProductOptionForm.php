<?php

namespace App\Twig\Components;

use App\Entity\ProductOption;
use App\Form\ProductOptionType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\FormInterface;
use Symfony\UX\LiveComponent\Attribute\AsLiveComponent;
use Symfony\UX\LiveComponent\Attribute\LiveProp;
use Symfony\UX\LiveComponent\DefaultActionTrait;
use Symfony\UX\LiveComponent\LiveCollectionTrait;

#[AsLiveComponent]
final class ProductOptionForm extends AbstractController
{
    use DefaultActionTrait;
    use LiveCollectionTrait;


    #[LiveProp(writable: true, fieldName: 'productOption')]
    public ?ProductOption $productOption = null;

    protected function instantiateForm(): FormInterface
    {
        return $this->createForm(ProductOptionType::class, $this->productOption);
    }
}
