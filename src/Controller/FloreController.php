<?php

namespace App\Controller;

use App\Entity\Flore;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

#[Route("/flore", requirements: ["_locale" => "en|es|fr"], name: "flore_")]
class FloreController extends AbstractController
{
    // Définition de la route 
    #[Route('/')]
    public function getAll(EntityManagerInterface $entityManager): Response
    {
        $images = $entityManager->getRepository(Flore::class)->findAll();

        if(!$images) {
            throw $this->createNotFoundException("Aucun livre n'est enregistré !");
        }

        return $this->render('flore/flore.html.twig', [
            'images' => $images
        ]);
    }
}