<?php

namespace App\Controller\Admin;

use App\Entity\Category;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/admin/category', name: 'app_admin_category_index')]
class CategoryController extends AbstractCrudController
{

    public static function getEntityFqcn(): string
    {
        return Category::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->onlyOnIndex(),
            TextField::new('name'),
            TextField::new('slug')
                ->hideOnForm() // Slug is typically auto-generated and shouldn't be editable
                ->setPermission('ROLE_ADMIN'), // Optional: restrict who can see the slug
            AssociationField::new('parent')
                ->setCrudController(self::class) // Important for the association to work properly
                ->autocomplete(), // Optional: enables autocomplete for large collections
            AssociationField::new('children')
                ->setCrudController(self::class)
                ->hideOnForm(),
        ];
    }
}