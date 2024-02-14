<?php

namespace App\Controller;

use App\Entity\MarquePage;
use DateTime;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;

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
        #[Route('/marquepage/ajouter')]
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

            return new Response("<a href='/'>Retourner</a>");
        }
}
