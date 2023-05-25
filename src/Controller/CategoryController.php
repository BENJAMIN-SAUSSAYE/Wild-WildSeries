<?php

namespace App\Controller;

use App\Entity\Category;
use App\Entity\Program;
use App\Form\CategoryType;
use App\Repository\CategoryRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/category', name: 'category_')]
class CategoryController extends AbstractController
{
    #[Route('/', methods: ['GET'], name: 'index')]
    public function index(CategoryRepository $categoryRepository): Response
    {
        return $this->render('category/index.html.twig', ['categories' => $categoryRepository->findAll()]);
    }

    #[Route('/new', name: 'new')]
    public function new(Request $request, CategoryRepository $categoryRepository): Response
    {
        // Create a new Category Object
        $category = new Category();

        // Create the form, linked with $category
        $form = $this->createForm(CategoryType::class, $category);

        // Get data from HTTP request
        $form->handleRequest($request);

        // Was the form submitted ?
        if ($form->isSubmitted()) {
            // Deal with the submitted data
            // For example : persiste & flush the entity
            // And redirect to a route that display the result
            $categoryRepository->save($category, true);

            // Redirect to categories list
            return $this->redirectToRoute('category_index');
        }

        // Render the form
        return $this->render('category/new.html.twig', [
            'form' => $form,
        ]);
    }

    #[Route('/{categoryName}', methods: ['GET'], name: 'show')]
    public function show(EntityManagerInterface $entityManager, string $categoryName): Response
    {
        $category = $entityManager->getRepository(Category::class)->findOneBy(['name' => $categoryName]);
        if (!$category) {
            throw $this->createNotFoundException(
                'Aucune catégorie nommée : ' . $categoryName . ' n\'à été trouvée dans la table [category].'
            );
        }

        //$programs = $entityManager->getRepository(Program::class)->findBy(['category' => $category], ['id' => 'ASC'], 3);
        $programs = $category->getPrograms();
        return $this->render('category/show.html.twig', ['programs' => $programs, 'category' => $category]);
    }
}
