<?php

namespace App\Controller;

use App\Entity\Gericht;
use App\Form\GerichtType;
use App\Repository\GerichtRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/*
 * @Route("/gericht", name="gericht.")
 */
class GerichtController extends AbstractController
{
    /**
     * @Route("/", name="edit")
     */
    public function index(GerichtRepository $gr)
    {
        $gerichte = $gr->findAll();

        return $this->render('gericht/index.html.twig', [
            'gerichte' => $gerichte, // 'controller_name' => 'GerichtController',
        ]);
    }

    /**
     * @Route("/create", name="create")
     */
    public function create(Request $request){
        $gericht = new Gericht();
        
        //form
        $form = $this->createForm(GerichtType::class, $gericht);
        $form->handleRequest($request);

        if($form->isSubmitted()){
            //EntityManager
            $em = $this->getDoctrine()->getManager();
            $image = $form->get('image_file')->getData();
            // $image = $request->files->get('image_file');
            // echo "<pre>";
            // var_dump($image);
            // echo "</pre>";
            // die();

            if($image){
                $dateiname = md5(uniqid()) . '.' . $image->guessClientExtension();
            }
            $image->move(
                $this->getParameter('images_folder'), $dateiname
            );
            
            $gericht->setImage($dateiname);
            $em->persist($gericht);
            $em->flush();

            //message
            $this->addFlash('success', "Dish was created successfully");

            return $this->redirect($this->generateUrl('home'));
        }

        //Response
        return $this->render('gericht/create.html.twig', [
            'createForm' => $form->createView(),
        ]);
    }

    /**
     * @Route("/delete/{id}", name="delete")
     */
    public function delete($id, GerichtRepository $gr){
        //EntityManager
        $em = $this->getDoctrine()->getManager();
        $gericht = $gr->find($id);
        $em->remove($gericht);
        $em->flush();

        //message
        $this->addFlash('success', 'Dish was removed successfully'); // success = erfolg

        return $this->redirect($this->generateUrl('home'));
    }
}
