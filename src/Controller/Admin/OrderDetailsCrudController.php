<?php

namespace App\Controller\Admin;

use App\Entity\OrderDetails;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\NumberField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class OrderDetailsCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return OrderDetails::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id', 'Id')->hideOnForm(),
            NumberField::new('quantity', 'Quantity'),
            AssociationField::new('product', 'Product'),
            AssociationField::new('customer_order', 'Order')
        ];
    }
}
