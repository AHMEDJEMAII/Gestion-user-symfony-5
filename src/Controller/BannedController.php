<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class BannedController extends AbstractController
{
    #[Route('/banned', name: 'app_banned')]
    public function index(): Response
    {
        return $this->render('banned/index.html.twig', [
            'controller_name' => 'BannedController',
        ]);
    }
}
