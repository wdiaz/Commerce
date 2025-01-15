<?php

declare(strict_types=1);

namespace App\Form;

use App\Entity\ProductOptionValue;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class SizeSelectorType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('size', EntityType::class, [
                'class' => ProductOptionValue::class,
                'choices' => $options['sizes'],  // Dynamically load size options
                'choice_label' => 'attribute_value',        // Use the size name or value
                'multiple' => false,              // Single selection
                'expanded' => false,              // Set true for dropdowns; false for radio buttons
                'label' => 'Select Size',
                'attr' => [
                    'class' => 'bg-white shadow-sm ring-0 block w-full text-lg focus:outline-none focus:border-tan-500 border-tan-300 p-2 border-2',
                ]
            ])
            ->add('quantity', ChoiceType::class, [
                'choices' => [
                    '1' => 1,
                    '2' => 2,
                    '3' => 3,
                    '4' => 4,
                    '5' => 5,
                    '6' => 6,
                    '7' => 7,
                    '8' => 8,
                    '9' => 9,
                    '10' => 10,
                    '11' => 11,
                ],
                'label' => 'Quantity',
            ])

            ->add('addToCart', SubmitType::class, [
                'label' => 'Add to Cart',
            ])

        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => null,  // Not mapping to a specific entity
            'sizes' => [],         // This allows dynamic size values
        ]);

        $resolver->setAllowedTypes('sizes', 'array');
    }
}
