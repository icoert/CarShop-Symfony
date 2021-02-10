<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\Employee;
use App\Form\EmployeeType;
use App\Form\ProductType;
use App\Entity\Product;
use App\Repository\EmployeeRepository;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

/**
* @Route("/employee", name="employee_")
*/
class EmployeeController extends AbstractController
{
    /**
     * @Route("/add", name="add")
     */
    public function addEmployee(Request $request, UserPasswordEncoderInterface $encoder): Response
    {
        $employee = new Employee();
        $form = $this->createForm(EmployeeType::class, $employee);
        $form
            ->remove('rate');
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            
            $employee=$form->getData();

            $encoded = $encoder->encodePassword($employee->getUser(), $employee->getUser()->getPassword());
            $employee->getUser()->setPassword($encoded);

            $em = $this->getDoctrine()->getManager();
            $em->persist($employee);
            $em->flush();

            return $this->render('employee/message.html.twig', [
                'message' => 'Angajat adaugat cu succes!'
            ]);

        }

        return $this->render('employee/addEmployee.html.twig', [
            'form' => $form->createView(),
            'title' => 'Adauga Angajat'
        ]);

    }

    /**
     * @Route("/read", name="read")
     */
    public function readEmployees(){
        $employees = $this->getDoctrine()->getRepository
        (Employee::class)->findAll();

        return $this->render('employee/show.html.twig', array('employees'=>$employees, 'special'=>' '));
    }

    /**
     * @Route("/update/{id}", name="update")
     */
    public function updateEmployee($id, Request $request, EmployeeRepository $employeeRepository): Response
    {
             $employee = $employeeRepository->find($id);

             if(!$employee){
                 throw $this->createNotFoundException(
            'Nu a fost gasit nici un angajat cu id-ul' . $id);
             }
            
             $form = $this->createForm(EmployeeType::class, $employee);
             $userForm = $form->get('user');
             $userForm->remove('password');
             $form
                 ->remove('rate'); 
             $form->handleRequest($request);
             if($form->isSubmitted() && $form->isValid()){
                // get data from form
                $employee=$form->getData();
                $em=$this->getDoctrine()->getManager(); 
                $em->flush();
                //return new Response('Succes');
                return $this->render('employee/message.html.twig', [
                    'message' => 'Angajatul cu id-ul ' .$id . ' a fost modificat cu succes!'
                ]);
            }

            return $this->render('employee/addEmployee.html.twig', [
                'form' => $form->createView(),
                'title' => 'Update employee: '
            ]);
    } 

    /**
     * @Route("/rate/{id}", name="rate")
     */
    public function rateEmployee($id, Request $request, EmployeeRepository $employeeRepository): Response
    {
        $employee = $employeeRepository->find($id);
        $oldNoRates = $employee->getNoRates();
        $oldRate = ($employee->getRate() * $oldNoRates);  
        
        $form=$this->createForm(EmployeeType::class, $employee);
        $form
            ->remove('user')
            ->remove('started_date') 
            ->remove('description'); 
        
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){

            $employee = $form->getData();
            $oldNoRates++;
            $newRate = $employee->getRate();
            $finalRate = ($oldRate + $newRate) / $oldNoRates;
            $employee->setRate($finalRate);
            $employee->setNoRates($oldNoRates);
            $em=$this->getDoctrine()->getManager(); 
            $em->flush();
            //return new Response('Succes');
            return $this->render('employee/message.html.twig', [
                'message' => 'Angajatul cu id-ul ' .$id . ' a fost modificat cu succes!'
            ]);
        }

        return $this->render('employee/addEmployee.html.twig', [
            'form' => $form->createView(),
            'title' => 'Rate employee: '
        ]);
    }

    /**
     * @Route("/remove/{id}", name="remove")
     */
    public function removeEmployee($id, Request $request, EmployeeRepository $employeeRepository): Response
    {
        
        $employee=$employeeRepository->find($id);

        if(!$employee){
            throw $this->createNotFoundException(
            'Nu a fost gasit nici un angajat cu id-ul' . $id);
        }
        $em=$this->getDoctrine()->getManager(); 
        $em->remove($employee);
        $em->flush();
        return $this->render('employee/message.html.twig', [
            'message' => 'Angajatul cu id-ul ' .$id . ' a fost sters cu succes!'
        ]);
    }
    
    /**
     * @Route("/read/products", name="read_products")
     */
    public function readEmployeesProducts(){
        $employees=$this->getDoctrine()->getRepository
        (Employee::class)->findAll();

        return $this->render('employee/showEmployeeProducts.html.twig', array('employees'=>$employees));
    }
}
