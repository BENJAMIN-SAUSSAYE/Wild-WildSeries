<?php

namespace App\DataFixtures;

use App\Entity\Season;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class SeasonFixtures extends Fixture implements DependentFixtureInterface
{
    public const SEASON_COUNT = 5;

    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create('fr_FR');

        for ($i = 0; $i < ProgramFixtures::PROGRAM_COUNT; $i++) {
            $program = $this->getReference('program_' . $i);
            for ($s = 0; $s < self::SEASON_COUNT; $s++) {
                $season = new Season();
                $season->setNumber($s + 1);
                $season->setYear($faker->numberBetween(2010, 2023));
                $season->setDescription($faker->realTextBetween($minNbChars = 80, $maxNbChars = 300, $indexSize = 2));
                $season->setProgram($program);
                $manager->persist($season);
                $this->addReference('season_' . strval($i) . strval($s), $season);
            }
        }
        $manager->flush();
    }

    public function getDependencies()
    {
        // Tu retournes ici toutes les classes de fixtures dont SeasonFixtures dépend
        return [
            ProgramFixtures::class,
        ];
    }
}
