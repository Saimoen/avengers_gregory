<?php

namespace App\Controller;

use App\Entity\MarquePage;
use App\Entity\MotCles;
use DateTime;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Doctrine\ORM\EntityManagerInterface;
use App\Form\Type\MarquePageType;
use Symfony\Component\HttpFoundation\Request;

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
        if (!$marquePage) {
            throw $this->createNotFoundException("Aucun livre n'est enregistré !");
        }

        // Transfère les données à la Vue
        return $this->render('liste/liste.html.twig', [
            'marquePage' => $marquePage,
        ]);
    }


    // Définition de la route 
    #[Route('/ajouter', name: 'Ajouter_MarquePage')]
    public function addMarquePage(Request $request, EntityManagerInterface $entityManager): Response
    {
        // Instanciation de la classe MarquePage
        $marquePage = new MarquePage();

        $form = $this->createForm(MarquePageType::class, $marquePage);

        $form->handleRequest($request);
        // Attribue les valeurs de l'objet en BDD
        if ($form->isSubmitted() && $form->isValid()) {
            $marquePage->setDateCreation(new DateTime('now'));

            // Retrieve the data for "motcles" from the form
            // $motClesData = $form->get('motcles')->getData();

            // // Check if the data is already an array, if not, convert it to an array
            // $motCles = is_array($motClesData) ? $motClesData : [$motClesData];

            // // Iterate over the array of motcles and add them to the $marquePage object
            // foreach ($motCles as $motCle) {
            //     $marquePage->addMotCle(new MotCles($motCle));
            // }

            // Persist the $marquePage object to the database
            $entityManager->persist($marquePage);
            $entityManager->flush();

            // Redirect to a success route
            return $this->redirectToRoute('livre_ajout_success');
        }


        return $this->render('marquepage/ajout.html.twig', [
            'form' => $form->createView(),
        ]);

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
