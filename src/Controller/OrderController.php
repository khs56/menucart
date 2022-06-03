<?php

namespace App\Controller;

use App\Entity\Order;
use App\Entity\Gericht;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class OrderController extends AbstractController
{
    #[Route('/order', name: 'app_order')]
    public function index(): Response
    {
        return $this->render('order/index.html.twig', [
            'controller_name' => 'OrderController',
        ]);
    }

    /**
     * @Route("order/{id}", name="order")
     */
    function order(Gericht $gericht)
    {
        $order = new Order();
        $order->setTisch("tisch1");
        $order->setName($gericht->getName());
        $order->setOrderNumber($gericht->getId());
        $order->setPrice($gericht->getPrice());
        $order->setStatus("Open");

        // entityManager
        $em = $this->getDoctrine()->getManager();
        $em->persist($order); //store the data
        $em->flush(); //send data to the database

        //message
        $this->addFlash('Order', $order->getName() . ' was added to the order');

        //redirect to cart
        return $this->redirect($this->generateUrl('menu'));
    }
}
