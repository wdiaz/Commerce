<?php

namespace App\Controller\Admin;

use App\Entity\ProductOption;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/admin/product-option', name: 'app_admin_product_option_index')]
class ProductOptionCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return ProductOption::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->hideOnForm(), // Hide ID on forms but show in listings
            TextField::new('name', 'Name'),
            TextField::new('optionType', 'Option Type'),
            TextField::new('attributeName', 'Attribute Name'),
            TextField::new('label', 'Label'),
            BooleanField::new('isRequired', 'Is Required'),
            IntegerField::new('displayOrder', 'Display Order'),
            AssociationField::new('productOptionValues', 'Option Values')
                ->setCrudController(ProductOptionValueCrudController::class),
            AssociationField::new('productVariantOptions', 'Variant Options')
                ->setCrudController(ProductVariantOptionCrudController::class),
        ];
    }
}
