<?php

namespace App\Controller;

use App\Entity\Adresse;
use App\Repository\LivreRepository;
use App\Repository\AuteurRepository;
use App\Entity\Livre;
use App\Form\Type\LivreType;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\Auteur;
use App\Entity\Employe;
use App\Form\Type\EmployeType;

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

        if (!$livres) {
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

        if (!$livres) {
            throw $this->createNotFoundException("Aucun livre n'est enregistré !");
        }

        // Refetch the Livre entity to get the latest data, including updated author information
        $livres = $entityManager->getRepository(Livre::class)->find($id);
        $auteur = $livres->getAuteurs();

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


        if (!$livresByLetter) {
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


        if (!$authors) {
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
        // Exemple pour ajouter un nouvel auteur
        $nouvelAuteur = new Auteur();
        $nouvelAuteur->setNom('Nom de l\'auteur'); // Assurez-vous d'ajuster cela en fonction de votre entité Auteur
        $nouvelAuteur->setPrenom('Prenom de l\'auteur'); // Assurez-vous de définir une valeur non nulle pour prenom

        $entityManager->persist($nouvelAuteur);

        // Associer le nouvel auteur au livre
        $livre->addAuteur($nouvelAuteur);


        $form = $this->createForm(LivreType::class, $livre);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // Récupérez l'auteur_id du formulaire et définissez-le sur le livre
            $livre->setAuteurId($form->get('auteur_id')->getData());

            $entityManager->persist($livre);
            $entityManager->flush();

            return $this->redirectToRoute('livre_ajout_success');
        }

        return $this->render('livre/ajout.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    #[Route('/ajoutEmploye', name: 'Ajouter_un_employe')]
    public function ajoutEmploye(Request $request, EntityManagerInterface $entityManager): Response
    {
        $employe = new Employe();

        $form = $this->createForm(EmployeType::class, $employe); 

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $employe->setAdresse($form->get('adresse')->getData());

            $entityManager->persist($employe);
            $entityManager->flush();

            return $this->redirectToRoute('livre_ajout_success');
        }

        return $this->render('employe/ajout.html.twig', [
            'form' => $form->createView(),
        ]);
    }


    #[Route('/modifier/{id}', name: 'modifier_livre')]
    public function modifier(Request $request, EntityManagerInterface $entityManager, Livre $livre): Response
    {
        // Récupérer l'auteur actuel du livre
        $auteurActuel = $livre->getAuteurId();

        $form = $this->createForm(LivreType::class, $livre);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // Si l'auteur a été modifié dans le formulaire, persistez-le séparément
            $nouvelAuteur = $form->get('auteur_id')->getData();

            if ($nouvelAuteur !== $auteurActuel) {
                // Dissocier le livre de l'ancien auteur
                if ($auteurActuel !== null) {
                    $auteurActuel->removeLivre($livre); // Use the correct method based on your Auteur entity
                    $entityManager->persist($auteurActuel);
                }

                // Associer le livre au nouvel auteur
                if ($nouvelAuteur !== null) {
                    $nouvelAuteur->addLivre($livre); // Use the correct method based on your Auteur entity
                    $entityManager->persist($nouvelAuteur);
                    // Mettez à jour la propriété auteur_id du livre
                    $livre->setAuteurId($nouvelAuteur);
                } else {
                    // Si $nouvelAuteur est null, vous devez également définir la propriété auteur_id du livre à null
                    $livre->setAuteurId(null);
                }
            }

            // Ne pas oublier de persister et flush le livre
            $entityManager->persist($livre);
            $entityManager->flush();

            $entityManager->refresh($livre);

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
    #[Route('/ajout_success', name: 'ajout_success')]
    public function ajoutSuccess(): Response
    {
        return $this->render('livre/success.html.twig');
    }
}
