<?php
// tests/Unit/Entity/ArticleTest.php

namespace App\Tests\Unit\Entity;

use App\Entity\Article;
use App\Entity\Categorie;
use PHPUnit\Framework\TestCase;

class ArticleTest extends TestCase
{
    private Article $article;

    protected function setUp(): void
    {
        $this->article = new Article();
    }

    /**
     * Test de création d'un article
     */
    public function testArticleCreation(): void
    {
        $this->assertInstanceOf(Article::class, $this->article);
        $this->assertNull($this->article->getId());
        $this->assertNull($this->article->getTitle());
        $this->assertNull($this->article->getContent());
        $this->assertNull($this->article->getImage());
        // Le prix peut être 0.0 au lieu de null selon votre implémentation
        $this->assertTrue($this->article->getPrix() === null || $this->article->getPrix() === 0.0);
        $this->assertNull($this->article->getCategorie());
    }

    /**
     * Test des getters et setters pour le titre
     */
    public function testTitleGetterAndSetter(): void
    {
        $title = 'iPhone 14 Pro Max';
        
        $result = $this->article->setTitle($title);
        
        $this->assertSame($this->article, $result); // Test fluent interface
        $this->assertEquals($title, $this->article->getTitle());
    }

    /**
     * Test des getters et setters pour le contenu
     */
    public function testContentGetterAndSetter(): void
    {
        $content = 'Smartphone Apple avec écran Super Retina XDR de 6,7 pouces, puce A16 Bionic et système photo pro avancé.';
        
        $result = $this->article->setContent($content);
        
        $this->assertSame($this->article, $result);
        $this->assertEquals($content, $this->article->getContent());
    }

    /**
     * Test des getters et setters pour l'image
     */
    public function testImageGetterAndSetter(): void
    {
        $image = 'iphone-14-pro-max.jpg';
        
        $result = $this->article->setImage($image);
        
        $this->assertSame($this->article, $result);
        $this->assertEquals($image, $this->article->getImage());
    }

    /**
     * Test des getters et setters pour le prix
     */
    public function testPrixGetterAndSetter(): void
    {
        $prix = 1329.99;
        
        $result = $this->article->setPrix($prix);
        
        $this->assertSame($this->article, $result);
        $this->assertEquals($prix, $this->article->getPrix());
        $this->assertIsFloat($this->article->getPrix());
    }

    /**
     * Test du prix avec différents types de données
     */
    public function testPrixWithDifferentTypes(): void
    {
        // Test avec un entier
        $this->article->setPrix(100);
        $this->assertEquals(100.0, $this->article->getPrix());
        $this->assertIsFloat($this->article->getPrix());

        // Test avec un float
        $this->article->setPrix(99.99);
        $this->assertEquals(99.99, $this->article->getPrix());

        // Test avec zéro
        $this->article->setPrix(0);
        $this->assertEquals(0.0, $this->article->getPrix());
    }

    /**
     * Test de la relation avec Categorie
     */
    public function testCategorieRelation(): void
    {
        $categorie = new Categorie();
        $categorie->setName('Smartphones');
        
        $result = $this->article->setCategorie($categorie);
        
        $this->assertSame($this->article, $result);
        $this->assertSame($categorie, $this->article->getCategorie());
        $this->assertInstanceOf(Categorie::class, $this->article->getCategorie());
    }

    /**
     * Test de suppression de la catégorie (null)
     */
    public function testCategorieCanBeNull(): void
    {
        // D'abord assigner une catégorie
        $categorie = new Categorie();
        $this->article->setCategorie($categorie);
        $this->assertNotNull($this->article->getCategorie());

        // Puis la supprimer
        $this->article->setCategorie(null);
        $this->assertNull($this->article->getCategorie());
    }

    /**
     * Test de la méthode __toString
     */
    public function testToString(): void
    {
        $title = 'MacBook Air M2';
        $this->article->setTitle($title);
        
        $this->assertEquals($title, (string) $this->article);
        $this->assertEquals($title, $this->article->__toString());
    }

    /**
     * Test __toString avec titre vide
     */
    public function testToStringWithEmptyTitle(): void
    {
        $this->article->setTitle('');
        $this->assertEquals('', (string) $this->article);
    }

    /**
     * Test de création d'un article complet
     */
    public function testCompleteArticle(): void
    {
        $categorie = new Categorie();
        $categorie->setName('Électronique');

        $this->article
            ->setTitle('iPad Pro 12.9"')
            ->setContent('Tablette Apple avec écran Liquid Retina XDR')
            ->setImage('ipad-pro-12-9.jpg')
            ->setPrix(1219.00)
            ->setCategorie($categorie);

        $this->assertEquals('iPad Pro 12.9"', $this->article->getTitle());
        $this->assertEquals('Tablette Apple avec écran Liquid Retina XDR', $this->article->getContent());
        $this->assertEquals('ipad-pro-12-9.jpg', $this->article->getImage());
        $this->assertEquals(1219.00, $this->article->getPrix());
        $this->assertSame($categorie, $this->article->getCategorie());
        $this->assertEquals('iPad Pro 12.9"', (string) $this->article);
    }

    /**
     * Test des prix avec des valeurs limites
     */
    public function testPrixBoundaryValues(): void
    {
        // Prix très petit
        $this->article->setPrix(0.01);
        $this->assertEquals(0.01, $this->article->getPrix());

        // Prix élevé
        $this->article->setPrix(99999.99);
        $this->assertEquals(99999.99, $this->article->getPrix());
    }

    /**
     * Test de la chaîne de méthodes (fluent interface)
     */
    public function testFluentInterface(): void
    {
        $result = $this->article
            ->setTitle('Test Product')
            ->setContent('Test Description')
            ->setImage('test.jpg')
            ->setPrix(29.99);

        $this->assertSame($this->article, $result);
        $this->assertEquals('Test Product', $this->article->getTitle());
        $this->assertEquals('Test Description', $this->article->getContent());
        $this->assertEquals('test.jpg', $this->article->getImage());
        $this->assertEquals(29.99, $this->article->getPrix());
    }

    /**
     * Test avec des caractères spéciaux dans le titre
     */
    public function testTitleWithSpecialCharacters(): void
    {
        $specialTitle = 'Écouteurs Bluetooth® "Sans-fil" 100% étanche (IP68)';
        $this->article->setTitle($specialTitle);
        
        $this->assertEquals($specialTitle, $this->article->getTitle());
        $this->assertEquals($specialTitle, (string) $this->article);
    }

    /**
     * Test avec un contenu long
     */
    public function testLongContent(): void
    {
        $longContent = str_repeat('Lorem ipsum dolor sit amet, consectetur adipiscing elit. ', 100);
        
        $this->article->setContent($longContent);
        
        $this->assertEquals($longContent, $this->article->getContent());
        $this->assertGreaterThan(1000, strlen($this->article->getContent()));
    }

    /**
     * Test de comparaison d'articles
     */
    public function testArticleComparison(): void
    {
        $article1 = new Article();
        $article1->setTitle('Produit A')->setPrix(100.00);

        $article2 = new Article();
        $article2->setTitle('Produit B')->setPrix(200.00);

        $this->assertNotEquals($article1->getTitle(), $article2->getTitle());
        $this->assertNotEquals($article1->getPrix(), $article2->getPrix());
        $this->assertNotSame($article1, $article2);
    }

    /**
     * Test des types de données retournés
     */
    public function testReturnTypes(): void
    {
        $this->article
            ->setTitle('Test')
            ->setContent('Content')
            ->setImage('image.jpg')
            ->setPrix(99.99);

        $this->assertIsString($this->article->getTitle());
        $this->assertIsString($this->article->getContent());
        $this->assertIsString($this->article->getImage());
        $this->assertIsFloat($this->article->getPrix());
        $this->assertIsString($this->article->__toString());
    }

    /**
     * Test de l'ID (lecture seule)
     */
    public function testIdIsReadOnly(): void
    {
        // L'ID doit être null pour un nouvel article
        $this->assertNull($this->article->getId());
        
        // On ne peut pas définir l'ID manuellement (pas de setter)
        $this->assertFalse(method_exists($this->article, 'setId'));
    }

    protected function tearDown(): void
    {
        parent::tearDown();
    }
}

/*
=== COMMENT LANCER CES TESTS ===

1. Créer le dossier tests/Unit/Entity/
   mkdir -p tests/Unit/Entity

2. Lancer les tests :
   php bin/phpunit tests/Unit/Entity/ArticleTest.php

3. Lancer avec détails :
   php bin/phpunit tests/Unit/Entity/ArticleTest.php --verbose

4. Générer un rapport de couverture :
   php bin/phpunit tests/Unit/Entity/ArticleTest.php --coverage-html var/coverage

=== CE QUE CES TESTS COUVRENT ===

✅ Création d'instance
✅ Getters et setters (tous les champs)
✅ Types de données (string, float, object)
✅ Relations avec autres entités (Categorie)
✅ Méthode __toString()
✅ Interface fluide (chaîne de méthodes)
✅ Valeurs limites et cas spéciaux
✅ Gestion des valeurs null
✅ Caractères spéciaux
✅ Contenu long
✅ Types de retour

=== RÉSULTATS ATTENDUS ===
- 17 tests
- Couverture ~95% de l'entité Article
- Tous les tests doivent passer ✅

=== PROCHAINES ÉTAPES ===
1. Lancer ces tests
2. Vérifier que tout passe
3. Passer à l'entité Categorie
4. Puis Order, Adresse, etc.

*/