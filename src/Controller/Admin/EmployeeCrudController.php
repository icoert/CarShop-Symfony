<?php

namespace App\Controller\Admin;

use App\Entity\Employee;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\NumberField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Contracts\Field\FieldConfiguratorInterface;

class EmployeeCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Employee::class;
    }

    
    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id', 'Id')->hideOnForm(),
            NumberField::new('rate'),
            DateField::new('started_date', 'Started date'),
            TextEditorField::new('description', 'Description'), 
            AssociationField::new('user', 'User'),
            AssociationField::new('products', 'Products'),
        ];
    }
}
