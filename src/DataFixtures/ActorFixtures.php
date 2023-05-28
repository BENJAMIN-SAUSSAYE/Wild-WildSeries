<?php

namespace App\DataFixtures;

use App\Entity\Actor;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class ActorFixtures extends Fixture implements DependentFixtureInterface
{
    public const ACTOR_COUNT = 10;

    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create('fr_FR');
        for ($s = 0; $s < self::ACTOR_COUNT; $s++) {
            $actor = new Actor();
            $actor->setName($faker->name(array_rand(['male', 'female'], 1)));

            // Ajoute aléatoirement 3 programmes à chaque acteur.
            while ($actor->getPrograms()->count() < 4) {
                $program_ref = $faker->numberBetween(0, (ProgramFixtures::PROGRAM_COUNT - 1));

                $program = $this->getReference('program_' . $program_ref);
                if (!$actor->getPrograms()->contains($program)) {
                    $actor->addProgram($program);
                    $this->addReference('actor_' . strval($program_ref) . $actor->getName(), $actor);
                }
            }
            $manager->persist($actor);
        }
        $manager->flush();
    }
    public function getDependencies()
    {
        // Tu retournes ici toutes les classes de fixtures dont ProgramFixtures dépend
        return [
            ProgramFixtures::class,
        ];
    }
}
