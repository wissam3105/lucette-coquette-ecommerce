<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use App\Form\OrderType;
use App\Entity\Adresse;
use App\Entity\User;
use App\Classe\Cart;
use App\Entity\Order;
use App\Entity\OrderDetails;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\Article;
use Stripe\Stripe;
use Stripe\Checkout\Session;




class OrderController extends AbstractController
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
     * @Route("/commande", name="order")
     */
    public function index(Cart $cart, Request $request): Response
    {
        if(! $this->getUser()->getAdresses()->getValues()){
            return $this->redirectToRoute('account_add');
        }



       $form = $this->createForm(OrderType::class, null, [
        'user'=>$this->getUser()
       ]);

        

        return $this->render('order/index.html.twig', [
            'controller_name' => 'OrderController',
            'form' => $form->createView(),
            'cart' => $cart->getCartContents(),
            'total' => $cart->getTotal()

        ]);
    }

/**
 * @Route("commande/recapi", name="recap")
 */
//public function add(Cart $cart, Request $request): Response
//{
//    
//    $form = $this->createForm(OrderType::class, null,[
//        'user'=>$this->getUser()
//    ]
//
//
//);
//
//    $form->handleRequest($request);
//    
//    if ($form->isSubmitted() && $form->isValid()) {
//        $date= new \DateTime();
//        $carrier=$form->get('carrier')->getData();
//        $delivery=$form->get('adresse')->getData();
//        $delivery_content = $delivery->getFirstname().''.$delivery->getLastname();
//        $delivery_content = $delivery->getPhone();
//
//
//        if ($delivery->getCompany()){
//            $delivery_content = '</br>'.$delivery->getCompany();
//        }
//        
//        $delivery_content = $delivery->getAdresse();
//        $delivery_content = $delivery->getPostal().''. $delivery->getCity();
//        $delivery_content = $delivery->getCountry();
//
//       
////enregistrer ma commande
//
//       $order= new Order();
//       $order->setUser($this->getUser());
//       $order->setCreatedAt(new \DateTimeImmutable());
//       $order->setCarrierName($carrier->getName());
//       $order->setCarrierPrice($carrier->getPrice());
//       $order->setDelivery($delivery_content);
//       $order->setIsPaid(false); // Use the setter method to set "isPaid" to false
//       $this->entityManager->persist($order);
//       
//
//
//
//
//
// // Enregistrer mes produits OrderDetails
// foreach ( $cart->getCartContents() as $article){
    
      // $orderDetails=new OrderDetails();
      // $orderDetails->setMyorder($order);
      // $orderDetails->setArticle($article['article']->getTitle());
      // $orderDetails->setQuantity($article['quantite']);
//
      // $orderDetails->setPrice($article['article']->getPrix());
      // $orderDetails->setTotal($article['article']->getPrix() * $article['quantite'] );
      // $this->entityManager->persist($orderDetails);
//
      // 
      // }
       //$this->entityManager->flush();

    }

   // return $this->render('order/recap.html.twig', [
   //     'controller_name' => 'OrderController',
   //     
   //     'cart' => $cart->getCartContents(),
   //     'delivery'=>$delivery_content,
   //     'total' => $cart->getTotal()
   //     
   // ]);



