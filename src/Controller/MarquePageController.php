<?php

namespace App\Controller;

use App\Entity\MarquePage;
use App\Entity\MotCles;
use DateTime;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Doctrine\ORM\EntityManagerInterface;

#[Route("/marquepage", requirements: ["_locale" => "en|es|fr"], name: "marquepage_")]
class MarquePageController extends AbstractController
{
        // Définition de la route 
        #[Route('/')]
        public function getAll(EntityManagerInterface $entityManager): Response
        {
            // Récupère les livres dans la BDD
            $marquePage = $entityManager->getRepository(MarquePage::class)->findAll();
            
            // Gestion d'erreur
            if(!$marquePage) {
                throw $this->createNotFoundException("Aucun livre n'est enregistré !");
            }
    
            // Transfère les données à la Vue
            return $this->render('liste/liste.html.twig', [
                'marquePage' => $marquePage,
            ]);
        }


        // Définition de la route 
        #[Route('/ajouter')]
        public function addMarquePage(EntityManagerInterface $entityManager): Response
        {
            // Instanciation de la classe MarquePage
            $marquePage = new MarquePage();
            // Attribue les valeurs de l'objet en BDD
            $marquePage->setDateCreation(new DateTime('now'));
            $marquePage->setCommentaire("Test d'ajouter !");
            $marquePage->setUrl("Test d'ajouter !");

            // Sauvegarde les livres dans la BDD
            $marquePage = $entityManager->persist($marquePage);
            $entityManager->flush();

            return new Response("<h1>Marque Page ajouté</h1><a href='/'>Retourner</a>");
        }

        // Définition de la route 
        #[Route('/consulter/{id}', requirements: ["id" => "\d+"])]
        public function consulterDetails(int $id, EntityManagerInterface $entityManager): Response
        {
            // Cherche les marques pages en bdd selon l'ID de l'article
            $details = $entityManager->getRepository(MarquePage::class)->find($id);

            $motsCles = $details->getMotCles();
        
            if (!$details) {
                throw $this->createNotFoundException(
                    "Aucun marque page avec l'id " . $id
                );
            }
        
        
            // Ajoute les valeurs dans la Vue
            return $this->render('details/details.html.twig', [
                'details' => $details,
                'motCles' => $motsCles,
            ]);
        }
}
