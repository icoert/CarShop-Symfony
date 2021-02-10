<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\Employee;
use App\Repository\EmployeeRepository;
use App\Repository\CustomerRepository;

class MainController extends AbstractController
{
    /**
     * @Route("/", name="homepage")
     */
    public function index(Request $request, EmployeeRepository $employeeRepository, CustomerRepository $customerRepository): Response
    {
        $user = $this->getUser();

        if($user->getIsAdmin()) {
            return $this->redirect($this->generateUrl('admin'));
        }

        $employee = $employeeRepository->findOneBy(['user' => $user]);

        if(!$employee) {
            $customer = $customerRepository->findOneBy(['user' => $user]);
            return $this->render('main/homepage_customer.html.twig', [
                'customer' => $customer
        ]);
        } else {
            return $this->render('main/homepage_employee.html.twig', [
                'employee' => $employee
            ]);
        }   
    }
}