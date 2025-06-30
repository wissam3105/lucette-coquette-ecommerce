<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Form\ChangePasswordType;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;


class AccountPasswordController extends AbstractController
{
    private $entityManager;
    /**
     * @param $entityManager
     */
    public function __construct(EntityManagerInterface $entityManager, UserPasswordEncoderInterface $passwordEncoder)
    {
        $this->entityManager = $entityManager;
        $this->passwordEncoder = $passwordEncoder;
    }

    /**
     * @Route("/account_password", name="account_password")
     */
    public function index(Request $request): Response
    {
       $user=$this->getUser();
       $form = $this->createForm(ChangePasswordType::class, $user);
       $form->handleRequest($request);
       
       if ($form->isSubmitted() && $form->isValid()) {
        $old_password = $form->get('old_password')->getData();

       
        if ($this->passwordEncoder->isPasswordValid($user, $old_password)) {
            $new_Password = $form->get('new_Password')->getData();
            $encodedPassword = $this->passwordEncoder->encodePassword($user, $new_Password);


        $user->setPassword($encodedPassword);
       
        $this->entityManager->persist($user);
        $this->entityManager->flush();
        $this->addFlash('success', 'Votre mot de passe a été modifié avec succès.');
        }
    
        
       }

        return $this->render('account/password.html.twig',[
            'form' => $form->createView()
        ]);
    }

}
