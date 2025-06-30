<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\ArticleRepository;

class HomeController extends AbstractController
{

    
    /**
     * @Route("/", name="home")
     */
    public function index(ArticleRepository $articleRepository): Response
    {
        $articles = [];
        $article = $articleRepository->findAll();
        if(count($article)> 3)
        {
            array_push($articles, $article[0]);
            array_push($articles, $article[1]);
            array_push($articles, $article[2]);
        }

        return $this->render('home/index.html.twig', [
            'articles' => $articles,
        ]);
    }
    
   
            
    
}
