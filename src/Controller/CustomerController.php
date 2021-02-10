<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\Customer;
use App\Form\CustomerType;
use App\Form\OrderType;
use App\Form\DeliveryAddressType;
use App\Repository\CustomerRepository;
use App\Entity\Order;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

/**
* @Route("/customer", name="customer_")
*/
class CustomerController extends AbstractController
{
    /**
     * @Route("/add", name="add")
     */
    public function addCustomer(Request $request, UserPasswordEncoderInterface $encoder): Response
    {
        $customer= new Customer();
        $form=$this->createForm(CustomerType::class, $customer);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            
            $customer=$form->getData();

            $encoded = $encoder->encodePassword($customer->getUser(), $customer->getUser()->getPassword());
            $customer->getUser()->setPassword($encoded);

            $em=$this->getDoctrine()->getManager();
            $em->persist($customer);
            $em->flush();

            return $this->render('customer/customerMessage.html.twig', [
                'message' => 'Client adaugat cu succes!'
            ]);

        }

        return $this->render('customer/addCustomer.html.twig', [
            'form' => $form->createView(),
            'title' => 'Adauga Client'
        ]);

    }

    /**
     * @Route("/read", name="read")
     */
    public function readCustomers(){
        $customers=$this->getDoctrine()->getRepository
        (Customer::class)->findAll();

        return $this->render('customer/show.html.twig', array('customers'=>$customers, 'special'=>' '));
    }
    
     /**
     * @Route("/update/{id}", name="update")
     */
    public function updateCustomer($id, Request $request, CustomerRepository $customerRepository): Response
    {
             $customer=$customerRepository->find($id);

             if(!$customer){
                 throw $this->createNotFoundException(
                'Nu a fost gasit nici un client cu id-ul' . $id);
             }
            
             $form=$this->createForm(customerType::class, $customer);
             $userForm=$form->get('user');
             $userForm->remove('password');
             $form->handleRequest($request);
             if($form->isSubmitted() && $form->isValid()){
                // get data from form
                $customer=$form->getData();
            
                $em=$this->getDoctrine()->getManager(); 
                $em->flush();
                //return new Response('Succes');
                return $this->render('customer/customerMessage.html.twig', [
                    'message' => 'Clientul cu id-ul ' .$id . ' a fost modificat cu succes!'
                ]);
            }

            return $this->render('customer/addCustomer.html.twig', [
                'form' => $form->createView(),
                'title' => 'Update customer: '
            ]);
    }
    
    /**
     * @Route("/remove/{id}", name="remove")
     */
    public function removeCustomer($id, Request $request, CustomerRepository $customerRepository): Response
    {
        
        $customer=$customerRepository->find($id);

        if(!$customer){
            throw $this->createNotFoundException(
            'Nu a fost gasit nici un client cu id-ul' . $id);
        }
        $em=$this->getDoctrine()->getManager(); 
        $em->remove($customer);
        $em->flush();
        return $this->render('customer/customerMessage.html.twig', [
            'message' => 'Clientul cu id-ul ' .$id . ' a fost sters cu succes!'
        ]);
    }

    /**
     * @Route("/read/orders/{id}", name="read_orders")
     */
    public function readCustomersOrders($id, Request $request, CustomerRepository $customerRepository){
        $customer=$customerRepository->find($id);

        if(!$customer){
            throw $this->createNotFoundException(
            'Nu a fost gasit nici un client cu id-ul' . $id);
        }

        return $this->render('customer/showCustomerOrders.html.twig', ['customer'=>$customer]);
    }
}
