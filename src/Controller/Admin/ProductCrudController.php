<?php

namespace App\Controller\Admin;

use App\Entity\Product;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\MoneyField;
use EasyCorp\Bundle\EasyAdminBundle\Field\SlugField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Vich\UploaderBundle\Form\Type\VichImageType;

#[Route('/admin/product', name: 'app_admin_product_index')]
class ProductCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Product::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            TextField::new('sku', 'SKU'),
            TextField::new('name', 'Name'),
            SlugField::new('slug', 'Slug')->setTargetFieldName('name'),
            TextareaField::new('longDescription', 'Long Description')
                            ->setFormTypeOption('attr', ['class' => 'tinymce-editor']),
            MoneyField::new('price')
                ->setCurrency('USD')
                ->setNumDecimals(2)
                ->setStoredAsCents(false)
                ->setStoredAsCents(false)
                ->setFormTypeOptions([
                    'constraints' => [
                        new \Symfony\Component\Validator\Constraints\Range([
                            'min' => 5,
                            'max' => 5000.00,
                            'notInRangeMessage' => 'Price must be between $1 and $5000.00',
                        ]),
                    ],
                ]),

            AssociationField::new('merchant', 'Merchant'),
            AssociationField::new('categories', 'Categories'),
            // CollectionField::new('images', 'Images'),
            // CollectionField::new('productAttributes', 'Product Attributes'),
            // CollectionField::new('productVariants', 'Product Variants'),
            TextField::new('imageFile', 'Image File')
                ->setFormType(VichImageType::class)
                ->onlyOnForms(),
            ImageField::new('mainImage', 'Main Image')
                ->setBasePath('images/products')
                ->onlyOnIndex(),
        ];
    }

    public function configureActions(Actions $actions): Actions
    {
        // Add a custom action to view the product on the front end
        $viewOnFrontend = Action::new('viewOnFrontend', 'View on Frontend', 'fa fa-eye')
            ->linkToUrl(function (Product $product) {
                // Generate the front-end URL using the product ID and slug
                return $this->generateUrl('app_product_show', [
                    'id' => $product->getId(),
                    'slug' => $product->getSlug(),
                ], UrlGeneratorInterface::ABSOLUTE_URL);
            })
            ->setHtmlAttributes(['target' => '_blank']); // Open the link in a new window

        // Add the custom action to the index and detail actions
        return $actions
            ->add(Action::INDEX, $viewOnFrontend)
            ->add(Action::DETAIL, $viewOnFrontend)
            ->add(Action::EDIT, $viewOnFrontend)
        ;
    }
}
