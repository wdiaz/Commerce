<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class VariantOptionType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        foreach ($options['productOptions'] as $optionName => $optionValues) {
            $builder->add($optionName, ChoiceType::class, [
                'choices' => array_flip($optionValues),
                'placeholder' => sprintf('Select'),
                'label' => ucfirst($optionName),
                'attr' => [
                    'class' => 'px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 form-select',
                ]
            ]);
        }
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'productOptions' => [],
            'data_class' => null,
        ]);
    }
}