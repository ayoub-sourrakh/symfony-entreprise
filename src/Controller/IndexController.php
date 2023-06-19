<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class IndexController extends AbstractController
{
    #[Route('/', name: 'accueil')]
    public function index(): Response
    {

        /*
            Exemples de methodes disponibles dans AbstractController :

            render()            : Renvoie une réponse HTTP 
            redirectToRoute()   : Redirige vers la route fournie en argument
            createForm()        : Crée un formulaire
            getUser()           : Récupère les informations de l'utilisateur connecté
            addFlash()          : Ajoute un message flash (message temporaire). Pour un afifchage en front
        
        */

        return $this->render('index/index.html.twig');
    }

    #[Route('/equipe', name: 'equipe')]
    public function equipe(): Response
    {
        return $this->render('index/equipe.html.twig');
    }

    #[Route('/services', name: 'services')]
    public function services(): Response
    {
        return $this->render('index/services.html.twig');
    }

    #[Route('/realisations', name: 'realisations')]
    public function realisations(): Response
    {
        return $this->render('index/realisations.html.twig');
    }
}
