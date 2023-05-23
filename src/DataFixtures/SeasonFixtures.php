<?php

namespace App\DataFixtures;

use App\Entity\Season;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class SeasonFixtures extends Fixture implements DependentFixtureInterface
{
    const SEASONS = [
        ['progam-ref' => 'program_0', 'number' => 1, 'year' => 2010, 'description' => 'La première saison de [The Walking Dead], série télévisée américaine inspirée de la bande dessinée du même nom de Robert Kirkman et Charlie Adlard est constituée de six épisodes'],
        ['progam-ref' => 'program_0', 'number' => 2, 'year' => 2011, 'description' => 'La deuxième saison de [The Walking Dead], série télévisée américaine inspirée de la bande dessinée du même nom de Robert Kirkman et Charlie Adlard est constituée de treize épisodes'],
        ['progam-ref' => 'program_0', 'number' => 3, 'year' => 2012, 'description' => 'La troisième saison de [The Walking Dead], série télévisée américaine inspirée de la bande dessinée du même nom de Robert Kirkman et Charlie Adlard est constituée de seize épisodes'],
        ['progam-ref' => 'program_0', 'number' => 4, 'year' => 2013, 'description' => 'La quatrième saison de [The Walking Dead], série télévisée américaine inspirée de la bande dessinée du même nom de Robert Kirkman et Charlie Adlard est constituée de seize épisodes'],
        ['progam-ref' => 'program_0', 'number' => 5, 'year' => 2014, 'description' => 'La cinquième saison de [The Walking Dead], série télévisée américaine inspirée de la bande dessinée du même nom de Robert Kirkman et Charlie Adlard est constituée de seize épisodes'],
        ['progam-ref' => 'program_0', 'number' => 6, 'year' => 2015, 'description' => 'La sixième saison de [The Walking Dead], série télévisée américaine inspirée de la bande dessinée du même nom de Robert Kirkman et Charlie Adlard est constituée de seize épisodes'],
        ['progam-ref' => 'program_1', 'number' => 1, 'year' => 2023, 'description' => 'La première saison de [The Last Of Us], est constituée de 9 épisodes. Alors qu\'une pandémie a détruit la civilisation, un survivant aguerri se retrouve avec une jeune fille de 14 ans sur les bras. Quelles sont leurs chances de s\'en sortir entre la menace des infectés et l\'oppression militaire de FEDRA ?'],
        ['progam-ref' => 'program_2', 'number' => 1, 'year' => 2022, 'description' => 'La première saison de [The Watcher], est constituée de 7 épisodes. Un couple marié emménage dans la maison de leurs rêves. Peu de temps après, ils reçoivent des lettres de menace terrifiantes d\'un harceleur signant sous le pseudo "The Watcher".'],
        ['progam-ref' => 'program_3', 'number' => 1, 'year' => 2021, 'description' => 'La première saison de [De l\'autre côté], est constituée de 8 épisodes. La série est adaptée des Romans Graphiques créé par Robert Lawrence Stine édité par Boom! Studios".'],
        ['progam-ref' => 'program_4', 'number' => 1, 'year' => 2016, 'description' => 'La première saison de [Slasher], est constituée de 8 épisodes. De retour dans sa ville natale, Sarah Bennett fait face aux démons de son enfance alors qu\'un tueur en série s\'emploie à recréer les meurtres sanglants du passé.'],
        ['progam-ref' => 'program_4', 'number' => 2, 'year' => 2017, 'description' => 'La deuxième saison de [Slasher], est constituée de 8 épisodes. De retour dans le camp de vacances isolé où un crime a été commis il y a des années, d\'anciens moniteurs voient leur passé revenir les hanter.'],
        ['progam-ref' => 'program_4', 'number' => 3, 'year' => 2019, 'description' => 'La troisième saison de [Slasher], est constituée de 8 épisodes. Les habitants d\'un immeuble ayant autrefois ignoré l\'appel à l\'aide de leur voisin vivent désormais sous la torture d\'un tueur masqué... et d\'Internet... .'],
        ['progam-ref' => 'program_4', 'number' => 4, 'year' => 2021, 'description' => 'La quatrième saison de [Slasher], est constituée de 8 épisodes. Placés sur une île déserte, les membres d\'une riche famille dysfonctionnelle apprennent qu’ils vont devoir s’opposer les uns aux autres dans un cruel jeu de vie et de mort. Le gagnant repartira avec l\’intégralité de la fortune familiale. La tension atteint un nouveau palier lorsqu\'un tueur en série masqué les prend pour cible.'],
        ['progam-ref' => 'program_5', 'number' => 1, 'year' => 2022, 'description' => 'La première saison de [Red Rose], est constituée de 8 épisodes. Un groupe d\'étudiants britanniques téléchargent l\'application sinistre " Red Rose ", qui les encourage à relever des défis de plus en plus dangereux.'],
        ['progam-ref' => 'program_6', 'number' => 1, 'year' => 2011, 'description' => 'La première saison de [Grimm], est constituée de 22 épisodes. La série se déroule à Portland où un détective doit protéger toute âme vivante des sinistres personnages des contes des frères Grimm qui ont infiltré le monde réel.'],
        ['progam-ref' => 'program_6', 'number' => 2, 'year' => 2012, 'description' => 'La deuxième saison de [Grimm], est constituée de 22 épisodes. Alors que Rosalee et Monroe se rapprochent, Adalind tente de récuperer ses pouvoirs d’Hexenbiest. De son côté, Juliette, qui est à peine sortie de son coma, traverse des épreuves étranges. Pendant ce temps, Nick doit affronter de nouvelles créatures, toutes plus dangereuses les unes que les autres.'],
        ['progam-ref' => 'program_6', 'number' => 3, 'year' => 2013, 'description' => 'La troisième saison de [Grimm], est constituée de 22 épisodes. Ses dons se manifestant de façons différentes et inattendues, Nick se révèle plus fort que jamais, avec Juliette, sa bien-aimée, et son partenaire Hank, pour traquer inlassablement les criminels Wesen. Mais les choses changent autour de lui.'],
        ['progam-ref' => 'program_7', 'number' => 1, 'year' => 2022, 'description' => 'La troisième saison de [Tales of the Jedi], est constituée de 6 épisodes. Série d\'anthologie composée de courts métrages d\'animation dévoilant les origines de chevaliers Jedi emblématiques comme Ahsoka Tano et le comte Dooku.'],
    ];

    public function load(ObjectManager $manager): void
    {
        foreach (self::SEASONS as $key => $seasonItem) {
            $season = new Season();
            $season->setNumber($seasonItem['number']);
            $season->setYear($seasonItem['year']);
            $season->setDescription($seasonItem['description']);
            $season->setProgram($this->getReference($seasonItem['progam-ref']));
            $manager->persist($season);
            $this->addReference('season_' . ($key + 1), $season);
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
