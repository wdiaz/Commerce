<?php

namespace App\Form;

use App\Entity\Category;
use App\Entity\Merchant;
use App\Entity\Product;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Url;
use Vich\UploaderBundle\Form\Type\VichFileType;

class ProductType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name')
            ->add('sku', TextType::class)
            ->add('slug', TextType::class, [
                'required' => false,
            ])
            /*->add('images', CollectionType::class, [
                'entry_type' => ImageType::class,
                'prototype' => true,
                'allow_add' => true,
                'allow_delete' => true,
                'by_reference' => false,
            ])*/
            /*->add('mainImage', FileType::class, [
                'label' => 'Product Image',
                'required' => true,
                'mapped' => false,
            ])*/
            ->add('mainImage', TextType::class, [
                'label' => 'Main Image URL',
                'required' => false, // Set to true if the image URL is mandatory
                'attr' => [
                    'placeholder' => 'Enter the URL of the main image',
                ],
                'constraints' => [
                    new Url([
                        'message' => 'Please enter a valid URL.',
                    ]),
                ],
            ])

            ->add('merchant', EntityType::class, [
                'class' => Merchant::class,
                'choice_label' => 'name', // Assuming the Merchant entity has a 'name' property
                'label' => 'Merchant',
                'placeholder' => 'Select a merchant',
            ])
            ->add('price', MoneyType::class, [
                'label' => 'Price',
                'scale' => 2, // Specify the number of decimal places
                'currency' => 'USD', // Adjust the currency as needed
            ])

            ->add('imageFile', VichFileType::class, [
                'required' => false,
            ])
            ->add('longDescription', TextareaType::class)
            ->add('categories', EntityType::class, [
                'class' => Category::class,
                'choice_label' => 'name',
                'multiple' => true,
                'attr' => ['class' => 'js-product-categories'],
                'expanded' => false,
            ])

            ->add('productVariants', CollectionType::class, [
                'entry_type' => ProductVariantType::class,
                'allow_add' => true,
                'allow_delete' => true,
                'by_reference' => false,
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Product::class,
        ]);
    }
}
