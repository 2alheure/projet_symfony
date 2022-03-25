<?php

namespace App\Controller;

use App\Repository\JeuRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class JeuxController extends AbstractController {
    #[Route('/jeux', name: 'app_jeux_liste')]
    public function liste(JeuRepository $jr): Response {
        // Retrieve all
        return $this->render('jeux/index.html.twig', [
            'jeux' => $jr->findAll(),
        ]);
    }

    #[Route('/jeux/{id}', name: 'app_jeux_details')]
    public function details($id, JeuRepository $jr): Response {
        // Retrieve one
        return $this->render('jeux/details.html.twig', [
            'jeu' => $jr->find($id)
        ]);
    }

    #[Route('/jeux/create', name: 'app_jeux_create')]
    public function create(): Response {
        // Create
        return new Response('create');
    }

    #[Route('/jeux/{id}/update', name: 'app_jeux_update')]
    public function update(): Response {
        // Update
        return new Response('update');
    }

    #[Route('/jeux/{id}/delete', name: 'app_jeux_delete')]
    public function delete(): Response {
        // Delete
    }
}
