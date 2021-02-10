<?php

namespace App\Controller\Admin;

use App\Entity\Customer;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;

class CustomerCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Customer::class;
    }

    
    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id', 'Id')->hideOnForm(),
            AssociationField::new('delivery_address', 'Delivery address'),
            TextField::new('phone'),
            AssociationField::new('user', 'User'),
        ];
    }
    
}
