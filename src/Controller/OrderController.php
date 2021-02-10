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
use App\Repository\EmployeeRepository;
use App\Entity\Order;
use App\Services\OrderService;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use App\Entity\OrderDetails; 


/**
* @Route("/order", name="order_")
*/
class OrderController extends AbstractController
{ 

    /**
     * @Route("/add/{id}", name="add")
     */
    public function addOrder($id, Request $request, CustomerRepository $customerRepository, OrderService $orderService): Response
    {
        
        $customer = $customerRepository->find($id);

        if(!$customer){
            throw $this->createNotFoundException('Nu a fost gasit clientul cu id. ' . $id);
        }

        $order= new Order();
        
        $form=$this->createForm(OrderType::class, $order);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
           
            $order = $form->getData();

            $invalidProducts = $orderService->saveOrder($order, $customer);

            if(count($invalidProducts) > 0) {
                return $this->render('orders/addOrder.html.twig', [
                    'form' => $form->createView(),
                    'title' => 'Adauga Comanda',
                    'invalidProducts' => $invalidProducts
                ]);
            } else {
                return $this->render('orders/orderMessage.html.twig', [
                    'message' => 'Comanda a fost adaugata cu succes!'
                ]);
            }

        }

        return $this->render('orders/addOrder.html.twig', [
            'form' => $form->createView(),
            'title' => 'Adauga Comanda'
        ]);

    } 

     /**
     * @Route("/read/{id}", name="read")
     */
    public function readOrders($id, CustomerRepository $customerRepository ){
        
        $customer=$customerRepository->find($id);

        if(!$customer){
            throw $this->createNotFoundException('Nu a fost gasit clientul cu id. ' . $id);
        }else{
            
            $customers=[$customer];
        }

        return $this->render('orders/show.html.twig', array('customers'=>$customers, 'special'=>' '));
    }

     /**
     * @Route("/readall", name="read_all")
     */
    public function readAllOrders(){
        
        $orders=$this->getDoctrine()->getRepository(Order::class)->findAll();

        return $this->render('orders/showAllOrders.html.twig', array('orders'=>$orders, 'special'=>' '));
    }

    /**
     * @Route("/read/product/employee/{id}", name="read_product_orders")
     */
    public function readProductOrders($id, EmployeeRepository $employeeRepository){
        
        $employee=$employeeRepository->find($id);
        $orderDetailsRepo = $this->getDoctrine()->getRepository(OrderDetails::class);
        $ordersDetails = [];

        foreach($employee->getProducts() as $product){
            $ordersDetails = array_merge($ordersDetails, $orderDetailsRepo->findby(['product' => $product]));
        }

        return $this->render('orders/showProductOrders.html.twig', array( 'ordersDetails'=>$ordersDetails, 'special'=>'Comenzi.'));
    }

    /**
     * @Route("/update/{id}/{id_order}", name="update")
     */
    public function updateOrder(Customer $customer, $id_order, Request $request, OrderService $orderService): Response
    {
    
        foreach($customer->getOrders() as $ord) {
            if($ord->getId() == $id_order) {
                $order = $ord;
                break;
            }
        }

        if(!isset($order)){
            throw $this->createNotFoundException(
            'Nu a fost gasit nici o comanda cu id-ul ' . $id_order);
        }
        
        $form=$this->createForm(OrderType::class, $order);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){

            // get data from form
            $order = $form->getData();

            $invalidProducts = $orderService->saveOrder($order, $customer);

            if(count($invalidProducts) > 0) {
                return $this->render('orders/addOrder.html.twig', [
                    'form' => $form->createView(),
                    'title' => 'Adauga Comanda',
                    'invalidProducts' => $invalidProducts
                ]);
            } else {
                return $this->render('orders/orderMessage.html.twig', [
                    'message' => 'Comanda a fost modificata cu succes!'
                ]);
            }

            //return new Response
            return $this->render('orders/orderMessage.html.twig', [
                'message' => 'Comanda ' .$id_order . ' a fost modificata cu succes!'
            ]);
        }

        return $this->render('orders/addOrder.html.twig', [
            'form' => $form->createView(),
            'title' => 'Modifica Comanda'
        ]);
    } 

    /**
     * @Route("/employee/{id}/{id_order}", name="employee_update")
     */
    public function updateOrderByEmployee($id, $id_order, Request $request, OrderService $orderService): Response
    {
        $order=$this->getDoctrine()->getRepository(Order::class)->find($id_order);
        $customer=$this->getDoctrine()->getRepository(Customer::class)->find($id);
        
        $form=$this->createForm(OrderType::class, $order);
        $form
                ->remove('created_date')
                ->remove('delivery_date')
                ->remove('details');
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){

            $order = $form->getData();
            $customer->addOrder($order);
            $em=$this->getDoctrine()->getManager();
            $em->persist($order);
            $em->flush();
                        
            return $this->render('orders/orderMessage.html.twig', [
                    'message' => 'Comanda a fost modificata cu succes!'
                ]);
            
        }

        return $this->render('orders/addOrder.html.twig', [
            'form' => $form->createView(),
            'title' => 'Angajat modifica comanda'
        ]);
    } 

    /**
     * @Route("/remove/{id}/{id_order}", name="remove")
     */
    public function removeProduct(Customer $customer, $id_order, Request $request): Response
    {
        foreach($customer->getOrders() as $ord) {
            if($ord->getId() == $id_order) {
                $order = $ord;
                break;
            }
        }

        if(!isset($order)){
            throw $this->createNotFoundException(
            'Nu a fost gasita comanda cu id ' . $id_order);
        }
        
       
        $em=$this->getDoctrine()->getManager(); 
        $em->remove($order);
        $em->flush();
            
        return $this->render('products/productMessage.html.twig', 
        ['message' => 'Comanda ' . $id_order . ' a fost stearsa cu succes!']);

    } 
}