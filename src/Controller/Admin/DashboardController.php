<?php

namespace App\Controller\Admin;

use App\Entity\Car;
use App\Entity\Customer;
use App\Entity\ReservationStatus;
use App\Entity\Reservation;
use App\Entity\Coupon;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use EasyCorp\Bundle\EasyAdminBundle\Router\CrudUrlGenerator;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DashboardController extends AbstractDashboardController
{
    /**
     * @Route("/admin", name="admin")
     */
    public function index(): Response
    {
        $routeBuilder = $this->get(CrudUrlGenerator::class)->build();

        return $this->redirect($routeBuilder->setController(ReservationCrudController::class)->generateUrl());
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            // the name visible to end users
            ->setTitle('RentC')

            // the path defined in this method is passed to the Twig asset() function
            ->setFaviconPath('https://upload.wikimedia.org/wikipedia/commons/thumb/6/65/Circle-icons-car.svg/768px-Circle-icons-car.svg.png')

            // the domain used by default is 'messages'
            ->setTranslationDomain('my-custom-domain')

            // there's no need to define the "text direction" explicitly because
            // its default value is inferred dynamically from the user locale
            ->setTextDirection('ltr')

            // set this option if you prefer the page content to span the entire
            // browser width, instead of the default design which sets a max width
            ->renderContentMaximized()

            // set this option if you prefer the sidebar (which contains the main menu)
            // to be displayed as a narrow column instead of the default expanded design
//            ->renderSidebarMinimized()
            ;
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::linktoRoute('Home', 'fa fa-home', 'home');
        yield MenuItem::linkToCrud('Cars', 'fas fa-list', Car::class);
        yield MenuItem::linkToCrud('Customers', 'fas fa-list', Customer::class);
        yield MenuItem::linkToCrud('Reservations', 'fas fa-list', Reservation::class);
        yield MenuItem::linkToCrud('Reservation Statuses', 'fas fa-list', ReservationStatus::class);
        yield MenuItem::linkToCrud('Coupons', 'fas fa-list', Coupon::class);
    }
}
