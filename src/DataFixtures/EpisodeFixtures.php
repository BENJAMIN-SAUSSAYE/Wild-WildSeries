<?php

namespace App\DataFixtures;

use App\Entity\Episode;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;
use Symfony\Component\String\Slugger\SluggerInterface;

class EpisodeFixtures extends Fixture implements DependentFixtureInterface
{
    public const EPISODE_COUNT = 10;

    protected SluggerInterface $slugger;

    public function  __construct(SluggerInterface $sluggerInterface)
    {
        $this->slugger = $sluggerInterface;
    }

    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create('fr_FR');

        for ($i = 0; $i < ProgramFixtures::PROGRAM_COUNT; $i++) {
            for ($s = 0; $s < SeasonFixtures::SEASON_COUNT; $s++) {
                $season = $this->getReference('season_' . strval($i) . strval($s));
                for ($e = 0; $e < self::EPISODE_COUNT; $e++) {
                    $episode = new Episode();
                    $episode->setTitle($faker->sentence(3));
                    $episode->setNumber($e + 1);
                    $episode->setSynopsis($faker->paragraphs(3, true));
                    $episode->setSeason($season);
                    $episode->setDuration($faker->numberBetween(30, 180));
                    $slug = $this->slugger->slug($episode->getTitle());
                    $episode->setSlug($slug);
                    $manager->persist($episode);
                    $this->addReference('episode_' . strval($i) . strval($s) . strval($e), $episode);
                }
            }
        }
        $manager->flush();
    }

    public function getDependencies()
    {
        // Tu retournes ici toutes les classes de fixtures dont EpisodeFixtures dépend
        return [
            SeasonFixtures::class,
        ];
    }
}
