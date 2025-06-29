<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CommandeController extends AbstractController
{
    /**
     * @Route("/appcommande", name="appcommande")
     */
    public function index(): Response
    {
        return $this->render('commande/index.html.twig', [
            'controller_name' => 'CommandeController',
        ]);
    }
    public function compter_visite(){
        $email   = $email['email']; 
    $date = date('Y-m-d'); 
    $query = $pdo->prepare("
    INSERT INTO stats_visites (email,date , pages_vues) VALUES (:email , :date , 1)
    ON DUPLICATE KEY UPDATE pages_vues = pages_vues + 1
");
// 2. On execute la requête préparée avec nos paramètres
$query->execute(array(
    ':email'   => $email,
    ':date' => $date
));
}
}
