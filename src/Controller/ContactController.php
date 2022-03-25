<?php

namespace App\Controller;

use App\Form\ContactType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ContactController extends AbstractController {
    #[Route('/contact', name: 'app_contact')]
    public function index(Request $request): Response {

        $formulaire = $this->createForm(ContactType::class);
        $formulaire->handleRequest($request);

        if ($formulaire->isSubmitted() && $formulaire->isValid()) {
            // J'envoie mon mail

            return new Response('Email envoyé');
        } else {
            return $this->render('jeux/formulaire.html.twig', [
                'form' => $formulaire->createView()
            ]);
        }
    }
}
