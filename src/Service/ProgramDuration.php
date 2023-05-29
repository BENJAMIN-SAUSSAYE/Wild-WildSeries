<?php

namespace App\Service;

use App\Entity\Program;

class ProgramDuration
{
	public function calculate(Program $program): string
	{
		$totalMinutes = 0;

		foreach ($program->getSeasons() as $saison) {
			foreach ($saison->getEpisodes() as $episode) {
				$totalMinutes += $episode->getDuration();
			}
		}
		$totalHours = ($totalMinutes / 60);
		return strval($totalHours);
	}
}
