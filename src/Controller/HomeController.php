<?php

namespace App\Controller;

use App\Repository\GerichtRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class HomeController extends AbstractController
{
    /**
     * @Route("/", name="home")
     */
    public function index(GerichtRepository $gr)
    {
        $dish = $gr->findAll();
        $random = array_rand($dish, 2);

        return $this->render('home/index.html.twig', [
            // 'controller_name' => 'HomeController',
            'g1' => $dish[$random[0]],
            'g2' => $dish[$random[1]],
        ]);
    }
    
}
