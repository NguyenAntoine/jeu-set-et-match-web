<?php

namespace AppBundle\DataFixtures;

use AppBundle\Entity\Court;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

class CourtFixtures extends Fixture implements OrderedFixtureInterface, ContainerAwareInterface
{
    /**
     * @var ContainerInterface
     */
    private $container;

    public const COURT_1 = 'court-1';
    public const COURT_2 = 'court-2';

    public function setContainer(ContainerInterface $container = null)
    {
        $this->container = $container;
    }

    /**
     * {@inheritDoc}
     */

    public function load(ObjectManager $manager)
    {
        $court = new Court();
        $court->setName("Court N°1");
        $court->setTournament($this->getReference(TournamentFixtures::ROLAND_GARROS));
        $manager->persist($court);
        $this->addReference(self::COURT_1, $court);

        $court = new Court();
        $court->setName("Court N°2");
        $court->setTournament($this->getReference(TournamentFixtures::ROLAND_GARROS));
        $manager->persist($court);
        $this->addReference(self::COURT_2, $court);

        $manager->flush();
    }


    public function getOrder()
    {
        return 8;
    }
}