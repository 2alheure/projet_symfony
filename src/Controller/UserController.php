<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\UserType;
use App\Repository\UserRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class UserController extends AbstractController {
    #[Route('/user/{id}/update', name: 'app_user_update')]
    public function edit($id, UserRepository $ur, Request $request): Response {
        $user = $ur->find($id);
        $formulaire = $this->createForm(UserType::class, $user);
        $formulaire->handleRequest($request);

        if ($formulaire->isSubmitted() && $formulaire->isValid()) dd($user);

        return $this->render('jeux/formulaire.html.twig', [
            'form' => $formulaire->createView(),
        ]);
    }
}
