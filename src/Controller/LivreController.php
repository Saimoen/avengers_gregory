<?php

namespace App\Controller;

use App\Entity\Auteur;
use App\Entity\Livre;
use App\Entity\MarquePage;
use App\Entity\MotCles;
use DateTime;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Doctrine\ORM\EntityManagerInterface;

#[Route("/livre", requirements: ["_locale" => "en|es|fr"], name: "livre_")]
class LivreController extends AbstractController
{
    // Définition de la route 
    #[Route('/')]
    public function getAll(EntityManagerInterface $entityManager): Response
    {
        $livres = $entityManager->getRepository(Livre::class)->findAll();

        if(!$livres) {
            throw $this->createNotFoundException("Aucun livre n'est enregistré !");
        }

        // Transfère les données à la Vue
        return $this->render('livre/livre.html.twig', [
            'livres' => $livres,
        ]);
    }
    // Définition de la route 
    #[Route('/consulter/{id}', requirements: ["id" => "\d+"])]
    public function consulterLivre(int $id, EntityManagerInterface $entityManager): Response
    {
        $livres = $entityManager->getRepository(Livre::class)->find($id);
        $auteur = $livres->getAuteur();

        if(!$livres) {
            throw $this->createNotFoundException("Aucun livre n'est enregistré !");
        }

        // Transfère les données à la Vue
        return $this->render('livre_details/livre_details.html.twig', [
            'livres' => $livres,
            'auteur' => $auteur
        ]);
    }
}
