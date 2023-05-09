<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


class HomeController extends AbstractController
{
    #[Route('/{name}', name: 'homepage', methods: ['GET'])]
    public function homepage(string $name = null): Response
    {
        return $this->render('default/index.html.twig', ['name' => $name ?? '',]);
    }
}
