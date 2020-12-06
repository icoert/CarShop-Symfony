<?php

namespace App\Controller;

use App\Entity\Reservation;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
//use Symfony\Bundle\FrameworkExtraBundle\Controller\Controller;

class ReservationController extends AbstractController
{
    /**
     * @Route("/reservations", name="reservation")
     */
    public function index(): Response
    {
        $reservations = "";

        return $this->render('reservations/index.html.twig', array('reservations' => $reservations));
    }
}
