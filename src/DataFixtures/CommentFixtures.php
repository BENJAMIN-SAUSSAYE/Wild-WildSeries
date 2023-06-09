<?php

namespace App\DataFixtures;

use App\Entity\Comment;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;


class CommentFixtures extends Fixture implements DependentFixtureInterface
{
    public const COMMENT_COUNT = 8;

    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create('fr_FR');

        for ($i = 0; $i < ProgramFixtures::PROGRAM_COUNT; $i++) {
            for ($s = 0; $s < SeasonFixtures::SEASON_COUNT; $s++) {
                for ($e = 0; $e < EpisodeFixtures::EPISODE_COUNT; $e++) {
                    $episode = $this->getReference('episode_' .  strval($i) . strval($s) . strval($e));
                    for ($u = 1; $u < self::COMMENT_COUNT; $u++) {
                        $comment = new Comment();
                        $user = $this->getReference('user_' . $faker->numberBetween(1, UserFixtures::USER_COUNT));
                        $comment->setAuthor($user);
                        $comment->setEpisode($episode);
                        $comment->setComment($faker->paragraph(4));
                        $comment->setRate($faker->numberBetween(1, 20));
                        $manager->persist($comment);
                    }
                }
            }
        }
        $manager->flush();
    }

    public function getDependencies()
    {
        // Tu retournes ici toutes les classes de fixtures dont CommentFixtures dépend
        return [
            EpisodeFixtures::class,
            UserFixtures::class,
        ];
    }
}
