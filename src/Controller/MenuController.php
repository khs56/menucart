<?php

namespace App\Controller;

use App\Repository\GerichtRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class MenuController extends AbstractController
{
    #[Route('/menu', name:'menu')]
    function menu(GerichtRepository $gr)
    {
        $gericht = $gr->findAll();

        return $this->render('menu/index.html.twig', [
            'gericht' => $gericht,
        ]);
    }
}
