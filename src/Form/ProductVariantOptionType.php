<?php
/**
 * Use in ProductVariantType. Line 28
 */
declare(strict_types=1);

namespace App\Form;

use App\Entity\ProductVariantOption;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use App\Entity\ProductOption;
use App\Entity\ProductOptionValue;

class ProductVariantOptionType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('productOption', EntityType::class, [
                'class' => ProductOption::class,
                'choice_label' => 'name', // Adjust according to your entity
            ])
            ->add('productOptionValue', EntityType::class, [
                'class' => ProductOptionValue::class,
                'choice_label' => 'attributeValue', // Adjust according to your entity
            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => ProductVariantOption::class,
        ]);
    }
}