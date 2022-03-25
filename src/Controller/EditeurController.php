<?php

namespace App\Controller;

use App\Repository\EditeurRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class EditeurController extends AbstractController {
    #[Route('/editeurs', name: 'app_editeurs_liste')]
    public function liste(EditeurRepository $er): Response {
        $editeurs = $er->findAll(); // findAll renvoie tous les éditeurs (tableau d'Editeur)

        return $this->render('editeur/liste.html.twig', [
            'editeurs' => $editeurs,
        ]);
    }

    #[Route('/editeurs/{id}', name: 'app_editeurs_details')]
    public function details($id, EditeurRepository $er) {
        $editeur = $er->find($id);

        return $this->render('editeur/details.html.twig', [
            'editeur' => $editeur,
        ]);
    }

    #[Route('/editeurs/{id}/delete', name: 'app_editeurs_delete')]
    public function delete($id, EditeurRepository $er) {
        $editeur = $er->find($id);
        $er->remove($editeur);

        return $this->redirectToRoute('app_editeurs_liste');
    }
}
