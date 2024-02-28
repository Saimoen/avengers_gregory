<?php

namespace App\Controller;

use App\Entity\Auteur;
use App\Form\Type\AuteurType;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;

#[Route("/auteur", requirements: ["_locale" => "en|es|fr"], name: "auteur_")]
class AuteurController extends AbstractController {
    #[Route('/', name: 'getAll')]
    public function getAll(EntityManagerInterface $entityManager): Response
    {
        $auteurs = $entityManager->getRepository(Auteur::class)->findAll();

        if(!$auteurs) {
            throw $this->createNotFoundException("Aucun auteur n'est enregistré !");
        }

        return $this->render('auteur/auteur.html.twig', [
            'auteurs' => $auteurs,
        ]);
    }

    #[Route('/ajout', name: 'Ajouter_un_auteur')]
    public function ajout(Request $request, EntityManagerInterface $entityManager): Response
    {
        $auteur = new Auteur();

        $auteur->setNom('Hugo');
        $auteur->setPrenom('Victor');

        $form = $this->createForm(AuteurType::class, $auteur); // Assurez-vous d'avoir créé un formulaire LivreType
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($auteur);
            $entityManager->flush();

            return $this->redirectToRoute('auteur_ajout_succes');
            
        }

        return $this->render('auteur/ajout.html.twig', [
            'form' => $form->createView(),
        ]);        
    }

    #[Route('/ajout_succes', name: 'ajout_succes')]
    public function success(): Response
    {
        return $this->render('auteur/success.html.twig');  
    }

    #[Route('/modifier/{id}', name: 'modifier_auteur')]
    public function modifier(Request $request, EntityManagerInterface $entityManager, Auteur $auteur): Response
    {
        $form = $this->createForm(AuteurType::class, $auteur);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('auteur_modifier_success');
        }

        return $this->render('auteur/modifier.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    #[Route('/modification_succes', name: 'modifier_success')]
    public function modificationSuccess(): Response
    {
        return $this->render('auteur/modifier_success.html.twig');
    }
    
}