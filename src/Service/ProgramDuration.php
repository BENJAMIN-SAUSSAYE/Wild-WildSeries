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
		return $this->convertMinuteToDaysHours($totalMinutes);
	}

	private function convertMinuteToDaysHours(int $numberOfMinutes): string
	{
		if ($numberOfMinutes < 60) {
			return sprintf("%d mins", $numberOfMinutes);
		} else if ($numberOfMinutes % 60 == 0) { // No minutes - i.e. not a fractional hour.
			return sprintf("%d hrs", $numberOfMinutes / 60);
		} else if ($numberOfMinutes < 1440) { //1 day = 1440 minutes
			return sprintf("%d hrs, %d mins", $numberOfMinutes / 60, $numberOfMinutes % 60);
		} else {
			$days = (int)floor($numberOfMinutes / 1440);
			$hours = (int)floor($numberOfMinutes % 1440 / 60);
			$minutes = (int)floor(($numberOfMinutes % 1440 % 60) % 60);
			return sprintf("%d days, %d hrs, %d mins", $days, $hours, $minutes);
		}
	}
}
