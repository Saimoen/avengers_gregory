<?php

namespace App\Controller;

use App\Entity\MarquePage;
use DateTime;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Doctrine\ORM\EntityManagerInterface;

#[Route("/cailloux", requirements: ["_locale" => "en|es|fr"], name: "cailloux_")]
class CaillouxController extends AbstractController
{
    // Définition de la route 
    #[Route('/')]
    public function getAll(): Response
    {
        return $this->render('cailloux/cailloux.html.twig');
    }
}