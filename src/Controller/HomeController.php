<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController {

    /**
     * @Route("/home", name="accueil")
     */
    public function home(): Response {
        $prenom = 'Jordan';

        return $this->render('home.html.twig', [
            'prenom' => strtoupper($prenom)
        ]);
    }
}
