<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HiController extends AbstractController
{
    #[Route('/', name: 'app_hi')]
    public function index(): Response
    {
        return $this->render('hi/index.html.twig', [
            'controller_name' => 'HiController',
        ]);
    }
}
