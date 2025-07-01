<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Adresse;
use App\Form\AdresseType;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\EntityManagerInterface;








class AccountAdresseCpntrollerController extends AbstractController
{
    private $entityManager;
    /**
     * @param $entityManager
     */
    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
       
    }


    /**
     * @Route("/adresse", name="adresse")
     */
    public function index(): Response
    {
      
         
        return $this->render('account/adresse.html.twig');
            
       
    }

    
    /**
     * @Route("/ajouter-une-adresse", name="account_add")
     */
    public function add(Request $request)
    {
        $adresse=new Adresse();
      $form = $this->createForm(AdresseType::class, $adresse);
    
        $form->handleRequest($request);
        
        if ($form->isSubmitted() && $form->isValid()) { 
            $adresse->setUser($this->getUser()); // Utilisez la méthode setUser() pour définir l'utilisateur
            $this->entityManager->persist($adresse);
            $this->entityManager->flush();
            return $this->redirectToRoute('adresse');
            
            
        }
         
        return $this->render('account/add.html.twig',[
            'form' => $form->createView(),
        ]
    
    );
    
       
    }
    
/**
 * @Route("/modifier-une-adresse/{id}", name="account_edit")
 */
public function edit(Request $request, $id, EntityManagerInterface $entityManager)
{
    $adresse = $entityManager->getRepository(Adresse::class)->find($id);

    if (!$adresse || $adresse->getUser() != $this->getUser()) {
        return $this->redirectToRoute('adresse');
    }




         $form = $this->createForm(AdresseType::class, $adresse);
       
    
        $form->handleRequest($request);
        
        if ($form->isSubmitted() && $form->isValid()) { 
            $this->entityManager->flush();
            return $this->redirectToRoute('adresse');
            
            
        }
         
        return $this->render('account/add.html.twig',[
            'form' => $form->createView(),
        ]
    
    );
    
       
    }


    /**
 * @Route("/supprimer -une-adresse/{id}", name="account_supp")
 */
public function supp( $id, EntityManagerInterface $entityManager)
{
    $adresse = $entityManager->getRepository(Adresse::class)->find($id);

    if (!$adresse || $adresse->getUser() !== $this->getUser()) {
        // Adresse non trouvée ou appartient à un autre utilisateur, vous pouvez afficher un message d'erreur ici si nécessaire
        return $this->redirectToRoute('adresse');
       
    }

    // Supprimez l'adresse
    $entityManager->remove($adresse);
    $entityManager->flush();
    
    // Redirigez l'utilisateur
    return $this->redirectToRoute('adresse');
            
            
        
         
       
    
   
    
       
    }
    
    
}
