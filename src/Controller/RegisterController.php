<?php

namespace App\Controller;
use App\Entity\User;
use App\Form\RegisterType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;



class RegisterController extends AbstractController

{
    public function __construct(EntityManagerInterface $em) {
      $this->em = $em;
  }

    /**
     * @Route("/inscription", name="inscription")
     */
    public function index(Request $request, UserPasswordEncoderInterface $encoder)
    {
      $user = new User();
      $form = $this->createForm(RegisterType::class, $user);

      $form->handleRequest($request);
      
      if ($form->isSubmitted() && $form->isValid()) { 
        $user = $form->getData();
        $plaintextPassword = $form["Password"]->getData();
     
        // hash the password (based on the security.yaml config for the $user class)
        $hashedPassword = $encoder->encodePassword($user,$user->getPassword());
        $user->setPassword($hashedPassword);   

        $this->em->persist($user);
        $this->em->flush();

        return $this->redirectToRoute('home');

      }

        return $this->render('register/index.html.twig',[
            'form' => $form->createView()
        ]);
            
    }
}
