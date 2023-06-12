<?php

namespace App\Twig\Components;

use App\Repository\CategoryRepository;
use Symfony\UX\TwigComponent\Attribute\AsTwigComponent;

#[AsTwigComponent('_dropdown_categories_menu')]
final class DropdownCategoriesMenu
{
	public function __construct(private CategoryRepository $categoryRepository)
	{
	}

	public function getCategories(): array
	{
		return $this->categoryRepository->findBy([], ['name' => 'ASC']);
	}
}
