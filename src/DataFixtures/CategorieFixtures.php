<?php

namespace App\DataFixtures;

use App\Entity\Categorie;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class CategorieFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $nomsCategories = [
            'Savon naturel',
            'Savon au lait de chèvre',
            'Savon exfoliant',
            'Savon liquide',
            'Savon parfumé'
        ];

        foreach ($nomsCategories as $nom) {
            $categorie = new Categorie();
            $categorie->setName($nom); // ← ta méthode dans l'entité
            $manager->persist($categorie);
        }

        $manager->flush();
    }
}

