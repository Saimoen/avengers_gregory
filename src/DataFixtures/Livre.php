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
        $listeAuteurs = array();

        for ($i=0; $i<25; $i++) {
            $auteur = new Auteur();
            $auteur->setNom('Nom de l\'auteur ' . $i);
            $auteur->setPrenom('Prénom de l\'auteur ' . $i);
            $manager->persist($auteur);
            $listeAuteurs[] = $auteur;
        }
        // Création de 15 livres
        for ($i = 0; $i < 250; $i++) {
            $livre = new Livre();
            $livre->setTitre('Livre n°' . $i);
            $livre->setAnnee(mt_rand(1975, 2020));
            $livre->setAuteurId($auteur);
            $manager->persist($livre);
        }
        $manager->flush();
    }
}
