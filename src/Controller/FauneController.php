<?php

namespace App\Controller;

use App\Entity\Faune;
use Doctrine\ORM\EntityManager;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Doctrine\ORM\EntityManagerInterface;

#[Route("/faune", requirements: ["_locale" => "en|es|fr"], name: "faune_")]
class FauneController extends AbstractController
{
    // Définition de la route 
    #[Route('/')]
    public function getAll(EntityManagerInterface $entityManager): Response
    {
        $images = $entityManager->getRepository(Faune::class)->findAll();

        if(!$images) {
            throw $this->createNotFoundException("Aucun livre n'est enregistré !");
        }

        return $this->render('faune/faune.html.twig', [
            'images' => $images
        ]);
    }
}