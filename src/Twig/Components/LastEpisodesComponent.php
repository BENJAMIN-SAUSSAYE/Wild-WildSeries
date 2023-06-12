<?php

namespace App\Twig\Components;

use App\Repository\EpisodeRepository;
use Symfony\UX\TwigComponent\Attribute\AsTwigComponent;

#[AsTwigComponent('_last_episodes')]
final class LastEpisodesComponent
{
	public function __construct(private EpisodeRepository $episodeRepository)
	{
	}

	public function getLastThreeEpisodes(): array
	{
		return $this->episodeRepository->findBy([], ['id' => 'ASC'], 3, null);
	}
}
