<?php

namespace App\DataFixtures;

use App\Entity\Program;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;
use Symfony\Component\String\Slugger\SluggerInterface;

class ProgramFixtures extends Fixture implements DependentFixtureInterface
{
    // private const IMG_PLACEHOLDER = 'https://placehold.co/400?text=';
    public const PROGRAM_COUNT = 25;
    protected SluggerInterface $slugger;

    public function  __construct(SluggerInterface $sluggerInterface)
    {
        $this->slugger = $sluggerInterface;
    }
    /**
     * Summary of load
     * @param \Doctrine\Persistence\ObjectManager $manager
     * @return void
     */
    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create('fr_FR');

        for ($i = 0; $i < self::PROGRAM_COUNT; $i++) {
            $program = new Program();
            $program->setTitle($faker->sentence(3, true));
            $program->setSynopsis($faker->paragraphs(3, true));
            $program->setCategory($this->getReference('category_' .  $faker->numberBetween(0, count(CategoryFixtures::CATEGORIES) - 1)));
            //$program->setPoster($faker->imageUrl(200, 200, 'serie', true));
            //$program->setPoster('https://picsum.photos/id/' .  $faker->numberBetween(1, 100) . '/250/300');
            $slug = $this->slugger->slug($program->getTitle());
            $program->setSlug($slug);
            $manager->persist($program);
            $this->addReference('program_' . strval($i), $program);
        }
        $manager->flush();
    }

    public function getDependencies()
    {
        // Tu retournes ici toutes les classes de fixtures dont ProgramFixtures dépend
        return [
            CategoryFixtures::class,
        ];
    }
}
