<?php

namespace App\Form;

use App\Entity\Product;
use App\Entity\ProductVariant;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ProductVariantType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('sku')
            ->add('quantity')
            ->add('price')
            ->add('main_image')
            ->add('thumbnail')
            /*->add('product', EntityType::class, [
                'class' => Product::class,
                'choice_label' => 'name',
            ])*/
            ->add('productVariantOptions', CollectionType::class, [
                'entry_type' => ProductVariantOptionType::class,
                'allow_add' => true,
                'allow_delete' => true,
                'by_reference' => false,
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => ProductVariant::class,
        ]);
    }
}
