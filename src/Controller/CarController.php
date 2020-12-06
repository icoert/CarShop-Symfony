<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
//use Symfony\Bundle\FrameworkExtraBundle\Controller\Controller;

class CarController extends AbstractController
{
    /**
     * @Route("/cars", name="car")
     */
    public function index(): Response
    {
        $cars = '';

        return $this->render('cars/index.html.twig', array('cars' => $cars));
    }
}
