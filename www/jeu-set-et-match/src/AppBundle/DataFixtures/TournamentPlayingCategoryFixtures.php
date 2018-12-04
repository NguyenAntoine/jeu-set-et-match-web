<?php

namespace AppBundle\DataFixtures;

use AppBundle\Entity\TournamentPlayingCategory;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

class TournamentPlayingCategoryFixtures extends Fixture implements OrderedFixtureInterface, ContainerAwareInterface
{
    /**
     * @var ContainerInterface
     */
    private $container;

    public const ROLAND_GARROS_SIMPLE_HOMMES = 'roland-garros-simple-hommes';

    public function setContainer(ContainerInterface $container = null)
    {
        $this->container = $container;
    }

    /**
     * {@inheritDoc}
     */

    public function load(ObjectManager $manager)
    {
        $tournamentPlayingCategory = new TournamentPlayingCategory();
        $tournamentPlayingCategory->setPlayingCategory($this->getReference(PlayingCategoryFixtures::SIMPLE_HOMMES));
        $tournamentPlayingCategory->setTournament($this->getReference(TournamentFixtures::ROLAND_GARROS));
        $manager->persist($tournamentPlayingCategory);
        $this->addReference(self::ROLAND_GARROS_SIMPLE_HOMMES, $tournamentPlayingCategory);

        $manager->flush();
    }


    public function getOrder()
    {
        return 9;
    }
}