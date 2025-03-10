<?php

namespace App\Controller\Admin;

use App\Entity\ProductVariant;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\MoneyField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/admin/product-variant', name: 'app_admin_product_variant_index')]
class ProductVariantCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return ProductVariant::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->hideOnForm(), // Hide ID on forms but show in listings
            TextField::new('sku', 'SKU'),
            AssociationField::new('product', 'Product')
                ->setCrudController(ProductCrudController::class), // Link to the Product CRUD controller
            IntegerField::new('quantity', 'Quantity'),
            MoneyField::new('price', 'Price')
                ->setCurrency('USD') // Set currency to USD (or your preferred currency)
                ->setStoredAsCents(false), // Ensure the price is stored as a decimal, not cents
            TextField::new('main_image', 'Main Image'),
            TextField::new('thumbnail', 'Thumbnail'),
            DateTimeField::new('createdAt', 'Created At')
                ->hideOnForm(), // Show in listings but hide on forms
            DateTimeField::new('updatedAt', 'Updated At')
                ->hideOnForm(), // Show in listings but hide on forms
            AssociationField::new('productVariantOptions', 'Variant Options')
                ->setCrudController(ProductVariantOptionCrudController::class),
        ];
    }
}