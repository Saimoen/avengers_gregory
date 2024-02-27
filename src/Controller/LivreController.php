<?php

namespace App\Controller;

use App\Entity\Livre;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Doctrine\ORM\EntityManagerInterface;
use App\Repository\LivreRepository;
use App\Repository\AuteurRepository;

#[Route("/livre", requirements: ["_locale" => "en|es|fr"], name: "livre_")]
class LivreController extends AbstractController
{
    private $livreRepository;

    public function __construct(LivreRepository $livreRepository)
    {
        $this->livreRepository = $livreRepository;
    }

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

    #[Route('/rechercher/{lettre}', requirements: ["lettre" => "\d+"])]
    public function getLivresByFirstLetter($letter)
    {
        $livresByLetter = $this->livreRepository->findLivresByFirstLetter($letter);

        
        if(!$livresByLetter) {
            throw $this->createNotFoundException("Aucun livre n'est enregistré !");
        }

        return $this->render('liste/liste.html.twig', [
            'livresByLetter' => $livresByLetter,
        ]);
    }

    #[Route('/rechercher/{auteur}', requirements: ["auteur" => "\d+"])]
    public function authors(AuteurRepository $auteurRepository)
    {
        $numberOfBooks = 3;
        $authors = $auteurRepository->findAuthorsWithMoreThanXBooks($numberOfBooks);

         
        if(!$authors) {
            throw $this->createNotFoundException("Aucun auteur n'est enregistré !");
        }

        return $this->render('liste/liste.html.twig', [
            'authors' => $authors,
        ]);
    }

    public function totalBooks(LivreRepository $livreRepository)
    {
        $totalBooks = $livreRepository->countTotalBooks();

        return $this->render('liste/liste.html.twig', [
            'totalBooks' => $totalBooks,
        ]);
    }
}
