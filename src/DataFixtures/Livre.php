<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class Livre extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        // $product = new Product();
        // $manager->persist($product);

        // Création de 15 livres
        for ($i = 0; $i < 15; $i++) {
            $livre = new Livre();
            $livre->setTitre('Livre ' . $i);
            $livre->setAnneeParution(mt_rand(1975, 2020));
            $livre->setNbPages(mt_rand(45, 1500));
            $manager->persist($livre);
        }
        $manager->flush();
        $manager->flush();
    }
}
