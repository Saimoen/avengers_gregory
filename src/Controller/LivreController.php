<?php

namespace App\Controller;

use App\Repository\LivreRepository;
use App\Repository\AuteurRepository;
use App\Entity\Livre;
use App\Form\Type\LivreType;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;


#[Route("/livre", requirements: ["_locale" => "en|es|fr"], name: "livre_")]
class LivreController extends AbstractController
{
    private $livreRepository;

    public function __construct(LivreRepository $livreRepository)
    {
        $this->livreRepository = $livreRepository;
    }

    // Définition de la route 
    #[Route('/', name: 'getAll')]
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

    #[Route('/all', name: 'all_books')]
    public function totalBooks(LivreRepository $livreRepository)
    {
        $totalBooks = $livreRepository->countTotalBooks();

        return $this->render('liste/liste.html.twig', [
            'totalBooks' => $totalBooks,
        ]);
    }

    #[Route('/ajout', name: 'Ajouter_un_livre')]
    public function ajout(Request $request, EntityManagerInterface $entityManager): Response
    {
        $livre = new Livre();
        $livre->setTitre('Les fleurs du Mal');
        $livre->setAnnee(1857);

        $form = $this->createForm(LivreType::class, $livre); // Assurez-vous d'avoir créé un formulaire LivreType
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($livre);
            $entityManager->flush();

            return $this->redirectToRoute('livre_ajout_succes');
            
        }

        return $this->render('livre/ajout.html.twig', [
            'form' => $form->createView(),
        ]);        
    }

    #[Route('/ajout_succes', name: 'ajout_succes')]
    public function success(): Response
    {
        return $this->render('livre/success.html.twig');  
    }

    #[Route('/modifier/{id}', name: 'modifier_auteur')]
    public function modifier(Request $request, EntityManagerInterface $entityManager, Livre $livre): Response
    {
        $form = $this->createForm(LivreType::class, $livre);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('livre_getAll');
        }

        return $this->render('livre/modifier.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    #[Route('/modification_succes', name: 'modifier_success')]
    public function modificationSuccess(): Response
    {
        return $this->render('livre/modifier_success.html.twig');
    }
}

