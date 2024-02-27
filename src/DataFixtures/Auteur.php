<?php

namespace App\DataFixtures;

use App\Entity\Auteur as EntityAuteur;
use App\Entity\Livre;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class Auteur extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        // Création de 15 auteurs
        for ($i = 0; $i < 15; $i++) {
            $noms = ['Hugo', 'Verne', 'Zola', 'Hemingway', 'Tolstoï', 'Dumas', 'Hugo', 'Verne', 'Zola', 'Hemingway', 'Tolstoï', 'Dumas', 'Hugo', 'Verne', 'Zola'];
            $prenoms = ['Victor', 'Jules', 'Emile', 'Ernest', 'Léon', 'Alexandre', 'Victor', 'Jules', 'Emile', 'Ernest', 'Léon', 'Alexandre', 'Victor', 'Jules', 'Emile'];
            $auteur = new EntityAuteur();
            $auteur->setNom($noms[array_rand($noms)]);
            $auteur->setPrenom($prenoms[array_rand($prenoms)]);
            $livre = new Livre();
            $livre->setTitre("Titre du livre");
            $auteur->setLivre($livre);
        }
        $manager->persist($auteur);
        $manager->flush();
    }
}
