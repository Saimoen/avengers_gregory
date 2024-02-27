<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Livre;
use App\Entity\Auteur;

class LivreFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        // Création de 15 livres
        for ($i = 0; $i < 15; $i++) {
            $livre = new Livre();
            $livre->setTitre('Livre n°' . $i);
            $livre->setAnnee(mt_rand(1975, 2020));
            $auteur = $manager->getRepository(Auteur::class)->find(mt_rand(1, 15));
            $livre->setAuteurId($auteur);
            $manager->persist($livre);
        }
        $manager->flush();
    }
}
