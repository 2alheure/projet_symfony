<?php

namespace App\Controller;

use Exception;
use App\Entity\Jeu;
use App\Form\JeuType;
use App\Repository\JeuRepository;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\HttpFoundation\Request;
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

    #[Route('/jeux/create', name: 'app_jeux_create')]
    public function create(Request $request, JeuRepository $jr): Response {

        $jeu = new Jeu;

        $formulaire = $this->createForm(JeuType::class, $jeu);
        $formulaire->handleRequest($request);

        if ($formulaire->isSubmitted() && $formulaire->isValid()) {
            $image = $formulaire->get('image')->getData(); // $image = une instance de UploadedFile
            $ok = true;

            if ($image) {
                $newName = 'jeu_' . uniqid() . '.' . $image->guessExtension(); // Je crée un nouveau nom

                try {
                    // Je déplace l'image vers sa nouvelle destination
                    $image->move(
                        $this->getParameter('imageDirectory'), // Le dossier de destination
                        $newName // Le nom du fichier à sa nouvelle destination
                    );

                    $jeu->setImage($newName);
                } catch (Exception $e) {
                    $this->addFlash('errors', 'Un problème est survenu pendant l\'upload du fichier.');
                    $ok = false;
                }
            }

            if ($ok) {
                $jr->add($jeu);
                return $this->redirectToRoute('app_jeux_liste');
            }
        }

        return $this->render('jeux/formulaire.html.twig', [
            'form' => $formulaire->createView(),
        ]);
    }

    #[Route('/jeux/{id}', name: 'app_jeux_details')]
    public function details($id, JeuRepository $jr): Response {
        // Retrieve one
        return $this->render('jeux/details.html.twig', [
            'jeu' => $jr->find($id)
        ]);
    }

    #[Route('/jeux/{id}/update', name: 'app_jeux_update')]
    public function update(): Response {
        // Update
        return new Response('update');
    }

    #[Route('/jeux/{id}/delete', name: 'app_jeux_delete')]
    public function delete(Jeu $id, JeuRepository $jr): Response {
        $jr->remove($id);

        /**
         * Avec FileSystem
         * (Attention : nécessite un composer require symfony/filesystem)
         */
        // $fs = new Filesystem;

        // if (
        //     !empty($id->getImage())
        //     && $fs->exists($this->getParameter('imageDirectory') . '/' . $id->getImage()) // Test savoir si l'image existe
        // )
        //     $fs->remove($this->getParameter('imageDirectory') . '/' . $id->getImage()); // Suppression de l'image


        /**
         * En bon vieux PHP
         */
        if (
            !empty($id->getImage())
            && file_exists($this->getParameter('imageDirectory') . '/' . $id->getImage()) // Test savoir si l'image existe
        )
            unlink($this->getParameter('imageDirectory') . '/' . $id->getImage()); // Suppression de l'image

        return $this->redirectToRoute('app_jeux_liste');
    }
}
