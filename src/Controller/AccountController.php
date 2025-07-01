<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Component\HttpFoundation\Request;


class AccountController extends AbstractController
{
    /**
     * @Route("/compte", name="account")
     */
    public function index(): Response
    {
        return $this->render('account/account.html.twig');
    }
    
        // ...
    
        /**
         * @Route("/mon-compte/modifier-mot-de-passe", name="account_change_password")
         * @IsGranted("ROLE_USER")
         */
        public function changePassword(Request $request, UserPasswordEncoderInterface $passwordEncoder): Response
        {
            $user = $this->getUser();
    
            if ($request->isMethod('POST')) {
                $newPassword = $request->request->get('new_password');
                $hashedPassword = $passwordEncoder->encodePassword($user, $newPassword);
    
                $user->setPassword($hashedPassword);
                $entityManager = $this->getDoctrine()->getManager();
                $entityManager->persist($user);
                $entityManager->flush();
    
                $this->addFlash('success', 'Votre mot de passe a été modifié avec succès.');
    
                return $this->redirectToRoute('account');
            }
    
            return $this->render('account/change_password.html.twig');
        }
    
       
    }
   
   