<?php

namespace App\Controller;

use App\Entity\Actor;
use App\Form\ActorType;
use App\Repository\ActorRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Address;
use Symfony\Component\Mime\Email;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/actor', name: 'app_actor_')]
class ActorController extends AbstractController
{
    #[Route('/', methods: ['GET'], name: 'index')]
    public function index(ActorRepository $actorRepository): Response
    {
        $actors = $actorRepository->findAll();

        return $this->render('actor/index.html.twig', ['actors' => $actors]);
    }


    #[Route('/new', name: 'new')]
    public function new(Request $request, MailerInterface $mailer, ActorRepository $actorRepository): Response
    {
        // Create a new Category Object
        $actor = new Actor();

        // Create the form, linked with $category
        $form = $this->createForm(ActorType::class, $actor);

        // Get data from HTTP request
        $form->handleRequest($request);

        // Was the form submitted ?
        if ($form->isSubmitted() && $form->isValid()) {

            $actorRepository->save($actor, true);

            $this->addFlash(
                'success',
                'L\'acteur a été ajouté'
            );

            $email = (new Email())
                ->from($this->getParameter('mailer_from'))
                ->to(new Address('destinataure@wild.com'))
                ->subject('Un acteur vient d\'être ajouté !')
                ->html($this->renderView(
                    'actor/newActorEmail.html.twig',
                    ['actor' => $actor]
                ));

            $mailer->send($email);

            // Redirect to categories list
            return $this->redirectToRoute('app_actor_index');
        }

        // Render the form
        return $this->render('actor/new.html.twig', [
            'form' => $form,
        ]);
    }

    #[Route('/{actor}', requirements: ['actor' => '\d+'], name: 'show', methods: ['GET'])]
    public function show(Actor $actor): Response
    {
        return $this->render('actor/show.html.twig', [
            'actor' => $actor,
        ]);
    }

    #[Route('/{actor}/edit', requirements: ['actor' => '\d+'],  name: 'edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Actor $actor, ActorRepository $actorRepository): Response
    {
        $form = $this->createForm(ActorType::class, $actor);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $actorRepository->save($actor, true);

            $this->addFlash(
                'success',
                'L\'acteur a été modifié'
            );

            // Redirect to actors list
            return $this->redirectToRoute('app_actor_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('actor/edit.html.twig', [
            'actor' => $actor,
            'form' => $form,
        ]);
    }

    #[Route('/{actor}', requirements: ['actor' => '\d+'], name: 'delete', methods: ['POST'])]
    public function delete(Request $request, Actor $actor, ActorRepository $actorRepository): Response
    {
        if ($this->isCsrfTokenValid('delete' . $actor->getId(), $request->request->get('_token'))) {
            $actorRepository->remove($actor, true);
            $this->addFlash(
                'danger',
                'L\'acteur a été supprimé'
            );
        }

        return $this->redirectToRoute('app_actor_index', [], Response::HTTP_SEE_OTHER);
    }
}
