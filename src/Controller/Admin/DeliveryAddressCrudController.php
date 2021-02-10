<?php

namespace App\Controller\Admin;

use App\Entity\DeliveryAddress;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class DeliveryAddressCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return DeliveryAddress::class;
    }

    /*
    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id'),
            TextField::new('title'),
            TextEditorField::new('description'),
        ];
    }
    */
}
