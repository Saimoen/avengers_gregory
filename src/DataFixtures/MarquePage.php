<?php

// src/DataFixtures/AppFixtures.php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\MarquePage;
use App\Entity\MotCles;

class MarquePageFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        // Création de 25 mots-clés
        $motCles = [];

        for ($i = 1; $i <= 25; $i++) {
            $motCle = new MotCles();
            $motCle->setContenu("MotCle$i");
            $manager->persist($motCle);
            $motCles[] = $motCle;
        }

        // Flush pour enregistrer les mots-clés dans la base de données
        $manager->flush();

        // Création de marque-pages avec des mots-clés associés
        $marquePages = [];

        for ($i = 1; $i <= 50; $i++) { // Change 50 to the desired number of marque-pages
            $marquePage = new MarquePage();
            $marquePage->setUrl("http://example.com/$i");
            $marquePage->setDateCreation(new \DateTime());
            $marquePage->setCommentaire("Commentaire pour le marque-page $i");

            // Associer entre 2 et 5 mots-clés aléatoirement
            $motClesCount = rand(2, 5);
            $selectedMotCles = array_rand($motCles, $motClesCount);

            foreach ($selectedMotCles as $index) {
                $marquePage->addMotCle($motCles[$index]);
            }

            $manager->persist($marquePage);
            $marquePages[] = $marquePage;
        }

        // Flush pour enregistrer les marque-pages dans la base de données
        $manager->flush();
    }
}
