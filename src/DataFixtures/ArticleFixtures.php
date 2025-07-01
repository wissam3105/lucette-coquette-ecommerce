<?php

namespace App\DataFixtures;

use App\Entity\Article;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class ArticleFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $articlesData = [
            ['Savon Naturel', 'Un savon 100% naturel sans parfum.', 4.99],
            ['Savon Nectar', 'Savon doux au parfum de nectar.', 5.49],
            ['Savon Rosé', 'Savon à base d\'eau de rose apaisante.', 5.99],
            ['Savon Épicé', 'Savon tonifiant aux épices.', 6.20],
            ['Savon Fraîcheur', 'Savon rafraîchissant aux herbes.', 5.10],
            ['Savon Douceur', 'Savon crémeux pour peaux sensibles.', 4.70],
            ['Savon de Provence', 'Savon artisanal aux huiles essentielles de lavande de Provence.', 5.80,],
            ['Savon Liquide Fraîcheur', 'Savon liquide rafraîchissant pour usage quotidien.', 4.60, ],
            ['Savon Noir Hammam', 'Savon noir traditionnel enrichi à l’huile d’olive pour un gommage doux du corps.', 19.99, ],
['Savon d’Alep Premium 40%', 'Savon syrien ancestral à 40% d’huile de baie de laurier, idéal pour les peaux sensibles.', 21.50, ],
['Coffret Savons Bio Assortis', 'Coffret cadeau contenant 4 savons bio parfumés (lavande, miel, eucalyptus, argile).', 23.90,],

        ];

        foreach ($articlesData as [$title, $content, $prix]) {
            $article = new Article();
            $article->setTitle($title)
                    ->setContent($content)
                    ->setPrix($prix)
                    ->setImage('https://via.placeholder.com/150x150'); // image générique;

            $manager->persist($article);
        }

        $manager->flush();
    }
}


