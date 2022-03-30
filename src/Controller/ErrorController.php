<?php

namespace App\Controller;

use Exception;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;

/**
 * Ce contrôleur a le même but que le testeur interne de Symfony
 * Vous avez des URL "/_error" données par Symfony 
 * En plus de ce contrôleur
 * 
 * @see https://symfony.com/doc/current/controller/error_pages.html
 */

#[Route('/error')]
class ErrorController extends AbstractController {
    #[Route('/404', name: 'e404')]
    public function e404() {
        throw new NotFoundHttpException;
    }

    #[Route('/403', name: 'e403')]
    public function e403() {
        throw new AccessDeniedHttpException;
    }

    #[Route('/500', name: '500')]
    public function e500() {
        throw new Exception;
    }
}
