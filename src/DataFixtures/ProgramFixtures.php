<?php

namespace App\DataFixtures;

use App\Entity\Program;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class ProgramFixtures extends Fixture implements DependentFixtureInterface
{
    const PROGRAMS = [
        [
            'title' => 'Walking dead',
            'synopsis' => 'Après une apocalypse ayant transformé la quasi-totalité de la population en zombies, un groupe d\'hommes et de femmes ' .
                'mené par l\'officier Rick Grimes tente de survivre. Ensemble, ils vont devoir tant bien que mal faire face à ce nouveau monde.',
            'category' => 'category_0',
            'poster' => 'walking_dead.jpeg'
        ],
        [
            'title' => 'The Last Of Us',
            'synopsis' => 'Pour Joel, la survie est une préoccupation quotidienne qu\'il gère à sa manière. Mais quand son chemin croise celui ' .
                'd\'Ellie, leur voyage à travers ce qui reste des États-Unis va mettre à rude épreuve leur humanité et leur volonté de survivre.',
            'category' => 'category_0',
            'poster' => 'the_last_of_us.webp'
        ],
        [
            'title' => 'The Watcher',
            'synopsis' => 'Lorsque la famille Brannock s\'installe dans sa maison de rêve, les choses deviennent vite infernales. ' .
                'D\'abord, d\'inquiétantes lettres signées d\'un mystérieux individu qui se fait appeler "Le Veilleur". Puis d\'effroyables révélations sur le voisinage.',
            'category' => 'category_4',
            'poster' => 'the_watcher.webp'
        ],
        [
            'title' => 'De l\'autre côté',
            'synopsis' => 'Une série d\'histoires de découverte de soi dans le monde du mystique et du paranormal. Nous explorons les mondes des sorcières, des extraterrestres, des fantômes et des dimensions alternatives.',
            'category' => 'category_4',
            'poster' => 'de_l_autre_cote.webp'
        ],
        [
            'title' => 'Slasher',
            'synopsis' => 'D\'ignobles tueurs en série sèment l\'effroi tandis que leurs prochaines victimes luttent pour leur survie dans cette terrifiante série d\'anthologie.',
            'category' => 'category_4',
            'poster' => 'the_slasher.jpg'
        ],
        [
            'title' => 'Red Rose',
            'synopsis' => 'Pendant les vacances d\'été, un groupe d\'étudiants britanniques téléchargent l\'application sinistre "Red Rose", qui les oblige à relever des défis de plus en plus dangereux et aux conséquences mortelles.',
            'category' => 'category_4',
            'poster' => 'red_rose.jpg'
        ],
        [
            'title' => 'Grimm',
            'synopsis' => 'A Portland, un détective doit protéger toute âme vivante des sinistres personnages des contes des frères Grimm qui ont infiltré le monde réel.',
            'category' => 'category_3',
            'poster' => 'grimm.jpg'
        ],
        [
            'title' => 'Tales of the Jedi',
            'synopsis' => 'Le passé et l\'origine de l\'apprentie d\'Anakin Skywalker, Ahsoka Tano, ainsi que l\'histoire du comte Dooku alors qu\'il s\'éloigne lentement' .
                ' du chemin des Jedi et finit par succomber au côté obscur de la Force.',
            'category' => 'category_2',
            'poster' => 'tales_of_the_Jedi.webp'
        ]
    ];
    /**
     * Summary of load
     * @param \Doctrine\Persistence\ObjectManager $manager
     * @return void
     */
    public function load(ObjectManager $manager): void
    {
        foreach (self::PROGRAMS as $key => $progItem) {
            $program = new Program();
            $program->setTitle($progItem['title']);
            $program->setSynopsis($progItem['synopsis']);
            $program->setCategory($this->getReference($progItem['category']));
            $program->setPoster($progItem['poster']);
            $manager->persist($program);
            $this->addReference('program_' . $key, $program);
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
