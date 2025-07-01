<?php

namespace App\Tests\Integration\Security;

use App\Entity\User;
use App\Entity\Article;
use App\Repository\UserRepository;
use App\Repository\ArticleRepository;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class UserSecurityTest extends KernelTestCase
{
    /**
     * Test d'intégration : Repository + Base de données (lecture seule)
     */
    public function testRepositoriesWork(): void
    {
        $kernel = self::bootKernel();
        $entityManager = $kernel->getContainer()->get('doctrine')->getManager();
        
        // Test UserRepository
        $userRepository = $entityManager->getRepository(User::class);
        $users = $userRepository->findAll();
        
        $this->assertIsArray($users);
        $this->assertInstanceOf(UserRepository::class, $userRepository);
        
        // Test ArticleRepository  
        $articleRepository = $entityManager->getRepository(Article::class);
        $articles = $articleRepository->findAll();
        
        $this->assertIsArray($articles);
        $this->assertInstanceOf(ArticleRepository::class, $articleRepository);
        
        // Si il y a des données, testons les méthodes
        if (count($users) > 0) {
            $firstUser = $users[0];
            $foundUser = $userRepository->findOneBy(['email' => $firstUser->getEmail()]);
            $this->assertNotNull($foundUser);
            $this->assertEquals($firstUser->getEmail(), $foundUser->getEmail());
        }
        
        if (count($articles) > 0) {
            $firstArticle = $articles[0];
            $foundArticle = $articleRepository->findOneBy(['title' => $firstArticle->getTitle()]);
            $this->assertNotNull($foundArticle);
            $this->assertEquals($firstArticle->getTitle(), $foundArticle->getTitle());
        }
    }

    /**
     * Test performance des requêtes
     */
    public function testRepositoryPerformance(): void
    {
        $kernel = self::bootKernel();
        $entityManager = $kernel->getContainer()->get('doctrine')->getManager();
        $userRepository = $entityManager->getRepository(User::class);
        
        // Mesurer le temps de findAll
        $startTime = microtime(true);
        $users = $userRepository->findAll();
        $endTime = microtime(true);
        
        $queryTime = $endTime - $startTime;
        
        $this->assertIsArray($users);
        $this->assertLessThan(2.0, $queryTime, 'La requête findAll est trop lente');
    }

    /**
     * Test des services Symfony
     */
    public function testSymfonyServices(): void
    {
        $kernel = self::bootKernel();
        $container = $kernel->getContainer();
        
        // Test que Doctrine fonctionne
        $doctrine = $container->get('doctrine');
        $this->assertNotNull($doctrine);
        
        $entityManager = $doctrine->getManager();
        $this->assertNotNull($entityManager);
        
        // Test du routeur
        $router = $container->get('router');
        $this->assertNotNull($router);
        
        // Test génération d'URL
        $homeUrl = $router->generate('home');
        $this->assertEquals('/', $homeUrl);
    }
}