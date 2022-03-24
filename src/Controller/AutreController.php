<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class AutreController extends AbstractController {
    /**
     * @Route("/autre-page")
     */
    public function autre() {
        return $this->redirectToRoute('accueil');
    }
}
