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

/**
* @Route("/product", name="product_")
*/
class ProductController extends AbstractController
{    
    /**
     * @Route("/add/{id}", name="add")
     */
    public function addProduct($id, Request $request, EmployeeRepository $employeeRepository): Response
    {
        
        $employee = $employeeRepository->find($id);

        if(!$employee){
            throw $this->createNotFoundException('Nu a fost gasit angajatul cu id. ' . $id);
        }

        $product= new Product();
        $form=$this->createForm(ProductType::class, $product);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            
            $product=$form->getData();
            $employee->addProduct($product);
            $em=$this->getDoctrine()->getManager();
            $em->persist($product);
            $em->flush();

            return $this->render('products/productMessage.html.twig', [
                'message' => 'Produsul a fost adaugat cu succes!'
            ]);

        }

        return $this->render('products/addProduct.html.twig', [
            'form' => $form->createView(),
            'title' => 'Adauga Produs'
        ]);

    }

    /**
     * @Route("/read/{id}", name="read")
     */
    public function readProducts($id, EmployeeRepository $employeeRepository ){
        
        $employee=$employeeRepository->find($id);

        if(!$employee){
            throw $this->createNotFoundException('Nu a fost gasit angajatul cu id. ' . $id);
        }

        return $this->render('products/showEmployeeProducts.html.twig', array('employee'=>$employee));
    }

    /**
     * @Route("/readall", name="read_all")
     */
    public function readAllProducts(){
        
        $products=$this->getDoctrine()->getRepository(Product::class)->findAll();

        return $this->render('products/showAllProducts.html.twig', array('products'=>$products));
    }


    /**
     * @Route("/update/{id}/{name}", name="update")
     */
    public function updateProduct(Employee $employee, $name, Request $request): Response
    {
    
        foreach($employee->getProducts() as $prod) {
            if($prod->getName() == $name) {
                $product = $prod;
                break;
            }
        }

        if(!isset($product)){
            throw $this->createNotFoundException(
            'Nu a fost gasit nici un produs cu numele ' . $name);
        }
        
        $form=$this->createForm(ProductType::class, $product);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            // get data from form
            $product=$form->getData();
            
            $em=$this->getDoctrine()->getManager(); 
            $em->flush();
            
            return $this->render('products/productMessage.html.twig', [
                'message' => 'Produsul a fost modificat cu succes!'
            ]);
        }

        return $this->render('products/addProduct.html.twig', [
            'form' => $form->createView(),
            'title' => 'Update product: '
        ]);
    } 

    /**
     * @Route("/remove/{id}/{name}", name="remove")
     */
    public function removeProduct(Employee $employee, $name, Request $request): Response
    {
    
        foreach($employee->getProducts() as $prod) {
            if($prod->getName() == $name) {
                $product = $prod;
                break;
            }
        }

        if(!isset($product)){
            throw $this->createNotFoundException(
            'Nu a fost gasit nici un produs cu numele ' . $name);
        }
        
       
        $em=$this->getDoctrine()->getManager(); 
        $em->remove($product);
        $em->flush();
            
        return $this->render('products/productMessage.html.twig', 
        ['message' => 'Produsul ' . $name . ' a fost sters cu succes!']);

    } 
}