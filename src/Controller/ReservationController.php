<?php

namespace App\Controller;

use App\Entity\Reservation;
use Doctrine\DBAL\Types\DateTimeType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
//use Symfony\Bundle\FrameworkExtraBundle\Controller\Controller;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\Common\Collections\ArrayCollection;

class ReservationController extends AbstractController
{
    /**
     * @Route("/reservations", name="reservation")
     */
    public function index(): Response
    {
        $reservations = $this->getDoctrine()->getRepository(Reservation::class)->findAll();

        return $this->render('reservations/index.html.twig', array('reservations' => $reservations));
    }

//    /**
//     * @Route("/reservations/new", name="new_reservation")
//     */
//    public function newReservation(Request $request)
//    {
//        $reservation = new Reservation();
//
//        $form = $this->createFormBuilder($reservation)->add('car', EntityType::class, [
//            'class' => Car::class,
//            'constraints' => [
//                new NotNull()
//            ]
//        ])
//        ->add('customer', EntityType::class, [
//            'class' => Customer::class,
//            'constraints' => [
//                new NotNull()
//        ]
//    ])
//        ->add('startDate', EntityType::class, [
//            'widget' => 'single_text',
//            'constraints' => [
//                new NotNull()
//            ]
//        ])
//        ->add('endDate', DateTimeType::class, [
//        'widget' => 'single_text',
//        'constraints' => [
//            new NotNull()
//        ]
//    ]);
//    }
}
