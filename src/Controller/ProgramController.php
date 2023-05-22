<?php

namespace App\Controller;

use App\Repository\ProgramRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/program', name: 'program_')]
class ProgramController extends AbstractController
{
    #[Route('/', methods: ['GET'], name: 'index')]
    public function index(): Response
    {
        return $this->render('program/index.html.twig');
    }

    #[Route('/{id}', requirements: ['id' => '\d+'], methods: ['GET'], name: 'show')]
    public function show(int $id = 1): Response
    {
        return $this->render('program/show.html.twig', ['id' => $id,]);
    }
}
