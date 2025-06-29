<?php

namespace App\Tests\Functional\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class HomeControllerTest extends WebTestCase
{
    /**
     * Test basique : la page d'accueil s'affiche-t-elle ?
     */
    public function testHomePageIsAccessible(): void
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/');

        $this->assertResponseIsSuccessful();
        $this->assertEquals(200, $client->getResponse()->getStatusCode());
    }

    /**
     * Test du contenu HTML
     */
    public function testHomePageHasHtmlContent(): void
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/');

        $this->assertResponseIsSuccessful();
        
        // Vérifier qu'on a du contenu HTML
        $this->assertGreaterThan(0, $crawler->filter('html')->count());
        $this->assertGreaterThan(0, $crawler->filter('body')->count());
    }

    /**
     * Test de la route nommée
     */
    public function testHomeRouteByName(): void
    {
        $client = static::createClient();
        $router = $client->getContainer()->get('router');
        
        // Vérifier que la route 'home' existe et pointe vers '/'
        $url = $router->generate('home');
        $this->assertEquals('/', $url);
        
        // Tester l'accès via cette URL générée
        $crawler = $client->request('GET', $url);
        $this->assertResponseIsSuccessful();
    }

    /**
     * Test des headers de réponse
     */
    public function testHomePageHeaders(): void
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/');

        $this->assertResponseIsSuccessful();
        
        $response = $client->getResponse();
        $this->assertTrue($response->headers->contains('content-type', 'text/html; charset=UTF-8'));
    }

    /**
     * Test de performance simple
     */
    public function testHomePageLoadsQuickly(): void
    {
        $client = static::createClient();
        
        $startTime = microtime(true);
        $crawler = $client->request('GET', '/');
        $endTime = microtime(true);
        
        $loadTime = $endTime - $startTime;
        
        $this->assertResponseIsSuccessful();
        $this->assertLessThan(3.0, $loadTime, 'La page d\'accueil met trop de temps à se charger');
    }
}

/*
=== INSTALLATION ET UTILISATION ===

1. Créer le dossier :
   mkdir -p tests/Functional

2. Créer le fichier :
   tests/Functional/HomeSimpleTest.php

3. Copier ce code dans le fichier

4. Lancer le test :
   php bin/phpunit tests/Functional/HomeSimpleTest.php

=== RÉSULTATS ATTENDUS ===
- 5 tests
- Tous doivent passer ✅
- Temps d'exécution rapide
- Aucune erreur de syntaxe

=== EXPLICATION POUR LE CDA ===
"J'ai créé des tests fonctionnels pour vérifier que ma page d'accueil 
fonctionne correctement. Ces tests vérifient que :
- La page est accessible (code 200)
- Le contenu HTML se génère bien
- La route fonctionne
- Les headers sont corrects
- Les performances sont acceptables

C'est essentiel pour s'assurer que les utilisateurs peuvent bien 
accéder à mon site e-commerce."

*/