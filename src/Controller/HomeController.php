<?php

namespace App\Controller;

use App\Entity\MarquePage;
use DateTime;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Doctrine\ORM\EntityManagerInterface;

class HomeController extends AbstractController
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
}