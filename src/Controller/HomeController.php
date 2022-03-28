<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController {

    /**
     * @Route("/", name="accueil")
     */
    public function home(): Response {

        if ($this->isGranted('ROLE_ADMIN')) dd('Je suis admin !');

        return $this->render('home.html.twig');
    }
}
