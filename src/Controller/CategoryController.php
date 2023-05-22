<?php

namespace App\Controller;

use App\Entity\Category;
use App\Entity\Program;
use App\Repository\CategoryRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
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

    #[Route('/{categoryName}', methods: ['GET'], name: 'show')]
    public function show(EntityManagerInterface $entityManager, string $categoryName): Response
    {
        $category = $entityManager->getRepository(Category::class)->findOneBy(['name' => $categoryName]);
        if (!$category) {
            throw $this->createNotFoundException(
                'Aucune catégorie nommée : ' . $categoryName . ' n\'à été trouvée dans la table [category].'
            );
        }
        $programs = $entityManager->getRepository(Program::class)->findBy(['category' => $category->getId()], ['id' => 'ASC'], 3);
        return $this->render('category/show.html.twig', ['programs' => $programs, 'category' => $category]);
    }
}
