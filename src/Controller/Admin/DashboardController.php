<?php

namespace App\Controller\Admin;

use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use App\Entity\User;
use App\Entity\Employee;
use App\Entity\Customer;
use App\Entity\Product;
use App\Entity\Category;
use App\Entity\Order;
use App\Entity\OrderDetails;

class DashboardController extends AbstractDashboardController
{
    /**
     * @Route("/admin", name="admin")
     */
    public function index(): Response
    {
        return parent::index();
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('Car Shop');
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::linktoDashboard('Home', 'fa fa-home');
        // yield MenuItem::linkToCrud('The Label', 'fas fa-list', EntityClass::class);

        yield MenuItem::linkToRoute('Login', 'fa fa-login', 'login');

        yield MenuItem::section('Entities');
        yield MenuItem::linkToCrud('User', 'fas fa-list', User::class);
        yield MenuItem::linkToCrud('Employee', 'fas fa-list', Employee::class);
        yield MenuItem::linkToCrud('Product', 'fas fa-list', Product::class);
        yield MenuItem::linkToCrud('Category', 'fas fa-list', Category::class);
        yield MenuItem::linkToCrud('Customer', 'fas fa-list', Customer::class);
        yield MenuItem::linkToCrud('Order', 'fas fa-list', Order::class);
        yield MenuItem::linkToCrud('OrderDetails', 'fas fa-list', OrderDetails::class);

        yield MenuItem::linkToLogout('Logout', 'fa fa-exit');
    }
}
