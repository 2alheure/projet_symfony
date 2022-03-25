<?php

namespace App\Controller;

use App\Entity\Editeur;
use App\Form\EditeurType;
use App\Repository\EditeurRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class EditeurController extends AbstractController {
    #[Route('/editeurs', name: 'app_editeurs_liste')]
    public function liste(EditeurRepository $er): Response {
        $editeurs = $er->findAll(); // findAll renvoie tous les éditeurs (tableau d'Editeur)

        return $this->render('editeur/liste.html.twig', [
            'editeurs' => $editeurs,
        ]);
    }

    #[Route('/editeurs/create', name: 'app_editeurs_create')]
    public function create(EditeurRepository $er, Request $request) {

        $editeur = new Editeur;

        $formulaire = $this->createForm(EditeurType::class, $editeur);

        $formulaire->handleRequest($request);

        if ($formulaire->isSubmitted() && $formulaire->isValid()) {
            $er->add($editeur);
            return $this->redirectToRoute('app_editeurs_liste');
        } else {
            return $this->render('editeur/formulaire.html.twig', [
                'formView' => $formulaire->createView(),
            ]);
        }
    }

    #[Route('/editeurs/{id}/update', name: 'app_editeurs_update')]
    public function update($id, EditeurRepository $er, Request $request) {

        $editeur = $er->find($id);

        $formulaire = $this->createForm(EditeurType::class, $editeur);

        $formulaire->handleRequest($request);

        if ($formulaire->isSubmitted() && $formulaire->isValid()) {
            $er->add($editeur);
            return $this->redirectToRoute('app_editeurs_liste');
        } else {
            return $this->render('editeur/formulaire.html.twig', [
                'formView' => $formulaire->createView(),
            ]);
        }
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
