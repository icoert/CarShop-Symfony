<?php

namespace App\Controller\Admin;

use App\Entity\User;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;

class UserCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return User::class;
    }

    
    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id', 'Id')->hideOnForm(),
            TextField::new('username', 'UserName'),
            TextEditorField::new('password', 'Password'),
            TextField::new('first_name', 'First Name'),
            TextField::new('last_name', 'Last Name'),
            AssociationField::new('customer'),
            AssociationField::new('employee'),
            IntegerField::new('isAdmin', 'Admin'),
        ];
    }
    
}
