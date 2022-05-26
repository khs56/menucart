<?php

namespace App\Controller;

use App\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class RegistryController extends AbstractController
{
    #[Route('/reg', name: 'reg')]
    public function index(): Response
    {
        $regForm = $this->createFormBuilder()
        ->add('username', textType::class, [
            'label' => 'Employee'])
        ->add('password', RepeatedType::class, [
            'type' => PasswordType::class,
            'required' => true,
            'first_options' => ['label' => 'Password'],
            'second_options' => ['label' => 'Repeat Password'],
            ])
            ->add('register', SubmitType::class)
            ->getForm();
        ;

        return $this->render('registry/index.html.twig', [
            // 'controller_name' => 'RegistryController',
            'regform'  => $regForm->createView()
        ]);
    }
}
