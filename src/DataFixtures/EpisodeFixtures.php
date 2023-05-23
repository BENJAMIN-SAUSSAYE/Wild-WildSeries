<?php

namespace App\DataFixtures;

use App\Entity\Episode;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class EpisodeFixtures extends Fixture implements DependentFixtureInterface
{
    const EPISODES = [
        ['season-ref' => 'season_1', 'nbr_episode' => 6],
        ['season-ref' => 'season_2', 'nbr_episode' => 13],
        ['season-ref' => 'season_3', 'nbr_episode' => 16],
        ['season-ref' => 'season_4', 'nbr_episode' => 16],
        ['season-ref' => 'season_5', 'nbr_episode' => 16],
        ['season-ref' => 'season_6', 'nbr_episode' => 16],
        ['season-ref' => 'season_7', 'nbr_episode' => 9],
        ['season-ref' => 'season_8', 'nbr_episode' => 7],
        ['season-ref' => 'season_9', 'nbr_episode' => 8],
        ['season-ref' => 'season_10', 'nbr_episode' => 8],
        ['season-ref' => 'season_11', 'nbr_episode' => 8],
        ['season-ref' => 'season_12', 'nbr_episode' => 8],
        ['season-ref' => 'season_13', 'nbr_episode' => 8],
        ['season-ref' => 'season_14', 'nbr_episode' => 8],
        ['season-ref' => 'season_15', 'nbr_episode' => 22],
        ['season-ref' => 'season_16', 'nbr_episode' => 22],
        ['season-ref' => 'season_17', 'nbr_episode' => 22],
        ['season-ref' => 'season_18', 'nbr_episode' => 6]
    ];
    public function load(ObjectManager $manager): void
    {
        foreach (self::EPISODES as $key => $episodeItem) {
            $season = $this->getReference($episodeItem['season-ref']);
            for ($numEpisode = 1; $numEpisode <= $episodeItem['nbr_episode']; $numEpisode++) {
                $episode = new Episode();
                $episode->setTitle('Épisode n° ' . $numEpisode . ' / ' . $episodeItem['nbr_episode']);
                $episode->setNumber($numEpisode);
                $episode->setSynopsis('Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque sapien velit, aliquet eget commodo nec, auctor a sapien. Nam eu neque vulputate diam rhoncus faucibus. Curabitur quis varius libero. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam placerat sem at mauris suscipit porta. Cras metus velit, elementum sed pellentesque a, pharetra eu eros. Etiam facilisis placerat euismod. Nam faucibus neque arcu, quis accumsan leo tincidunt varius. In vel diam enim. Sed id ultrices ligula. Maecenas at urna arcu. Sed.');
                $episode->setSeason($season);
                $manager->persist($episode);
            }
        }
        $manager->flush();
    }

    public function getDependencies()
    {
        // Tu retournes ici toutes les classes de fixtures dont ProgramFixtures dépend
        return [
            SeasonFixtures::class,
        ];
    }
}
