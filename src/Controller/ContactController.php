<?php

namespace App\Controller;

use App\Form\ContactType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;

class ContactController extends AbstractController {
    #[Route('/contact', name: 'app_contact')]
    public function index(Request $request, MailerInterface $mailer): Response {

        $formulaire = $this->createForm(ContactType::class);
        $formulaire->handleRequest($request);

        if ($formulaire->isSubmitted() && $formulaire->isValid()) {
            $data = $formulaire->getData();

            // J'envoie mon mail
            $email = new Email();
            $email->from('ContactForm <test@example.com>')
                ->to('destinataire@yopmail.com')
                ->subject($data['sujet'])
                ->text($data['message']);

            $mailer->send($email);

            return $this->redirectToRoute('accueil');
        } else {
            return $this->render('jeux/formulaire.html.twig', [
                'form' => $formulaire->createView()
            ]);
        }
    }
}
