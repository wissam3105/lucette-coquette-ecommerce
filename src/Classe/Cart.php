<?php
namespace App\Classe;

use App\Repository\ArticleRepository;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

class Cart
{
    private $session;
    private $articleRepository;

    public function __construct(SessionInterface $session, ArticleRepository $articleRepository)
    {
        $this->session = $session;
        $this->articleRepository = $articleRepository;
    }

    public function getCartContents()
    {
        $panier = $this->session->get('panier', []);
        $panierData = [];

        foreach ($panier as $id => $quantite) {
            $article = $this->articleRepository->find($id);
            if ($article) {
                $panierData[] = [
                    'article' => $article,
                    'quantite' => $quantite,
                ];
            }
        }

        return $panierData;
    }

    public function getTotal()
    {
        $panierData = $this->getCartContents();
        $total = 0;

        foreach ($panierData as $art) {
            $totalArt = $art['article']->getPrix() * $art['quantite'];
            $total += $totalArt;
        }

        return $total;
    }

    public function addToCart($id)
    {
        $panier = $this->session->get('panier', []);

        if (!empty($panier[$id])) {
            $panier[$id]++;
        } else {
            $panier[$id] = 1;
        }

        $this->session->set('panier', $panier);
    }

    public function removeFromCart($id)
{
    $panier = $this->session->get('panier', []);

    if (isset($panier[$id])) {
        if ($panier[$id] > 1) {
            $panier[$id]--; // Diminue la quantité de 1 si la quantité est supérieure à 1
        } else {
            unset($panier[$id]); // Supprime complètement l'article si la quantité est égale à 1
        }
    }

    $this->session->set('panier', $panier);
}






}





