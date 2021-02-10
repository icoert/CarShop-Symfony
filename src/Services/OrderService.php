<?php

namespace App\Services;

use App\Entity\Order;
use App\Entity\Product;
use App\Entity\Customer;
use Doctrine\ORM\EntityManagerInterface;

class OrderService
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function saveOrder(Order $order, Customer $customer)
    {
        $isValid = true;
        $invalidProducts = [];
        foreach($order->getDetails() as $orderDetails) {
            if($orderDetails->getQuantity() > $orderDetails->getProduct()->getQuantity()) {
                $isValid = false;
                $invalidProducts[] = $orderDetails->getProduct()->getName();
            }
        }

        if ($isValid) {
            $customer->addOrder($order);
            $this->entityManager->persist($order);

            foreach($order->getDetails() as $orderDetails) {
                $product = $orderDetails->getProduct();
                $product->setQuantity($product->getQuantity() - $orderDetails->getQuantity());
                $this->entityManager->persist($product);
            }

            $this->entityManager->flush();

            return [];
        } else {
            return $invalidProducts;
        } 
    }
}