<?php

namespace App\DataFixtures;

use App\Entity\Carrier;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class CarrierFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $transporteurs = [
            [
                'name' => 'Colissimo',
                'description' => 'Livraison en 2 à 3 jours ouvrés en France.',
                'price' => 4.90,
            ],
            [
                'name' => 'Mondial Relay',
                'description' => 'Livraison en point relais sous 3 à 5 jours.',
                'price' => 3.50,
            ],
            [
                'name' => 'Chronopost',
                'description' => 'Livraison express en 24h.',
                'price' => 9.90,
            ],
        ];

        foreach ($transporteurs as $data) {
            $carrier = new Carrier();
            $carrier->setName($data['name']);
            $carrier->setDescription($data['description']);
            $carrier->setPrice($data['price']);

            $manager->persist($carrier);
            echo "Transporteur ajouté : {$data['name']}\n";
        }

        $manager->flush();
    }
}
