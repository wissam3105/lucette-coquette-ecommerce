<?php

namespace App\Controller;

use App\Repository\ArticleRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\BrowserKit\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;
use App\Classe\Cart; // Ajoutez l'importation de la classe Cart

class PanierController extends AbstractController
{
    private $cart;

    public function __construct(Cart $cart)
    {
        $this->cart = $cart;
    }
   // ...
    
    /**
     * @Route("/panier", name="panier")
     */
    public function index(): Response
    {
        $panierData = $this->cart->getCartContents();
        $total = $this->cart->getTotal();

        return $this->render('panier/index.html.twig', [
            'panier' => $panierData,
            'total' => $total,
        ]);
    }

    /**
     * @Route("/panier/add/{id}", name="panier_add")
     */
    public function add($id)
    {
        $this->cart->addToCart($id);

        return $this->redirectToRoute('panier');
    }

    /**
     * @Route("/panier/delete/{id}", name="panier_delete")
     */
    public function delete($id)
    {
        $this->cart->removeFromCart($id);

        return $this->redirectToRoute("panier");
    }
    
    // ...
}
