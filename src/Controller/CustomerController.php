<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
//use Symfony\Bundle\FrameworkExtraBundle\Controller\Controller;

class CustomerController extends AbstractController
{
    /**
     * @Route("/customers", name="customer")
     */
    public function index(): Response
    {
        $customers = '';

        return $this->render('customers/index.html.twig', array('customers' => $customers));
    }
}
