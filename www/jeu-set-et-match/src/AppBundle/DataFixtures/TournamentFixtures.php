<?php

namespace AppBundle\DataFixtures;

use AppBundle\Entity\Tournament;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

class TournamentFixtures extends Fixture implements OrderedFixtureInterface, ContainerAwareInterface
{
    /**
     * @var ContainerInterface
     */
    private $container;

    public const ROLAND_GARROS = 'roland-garros';
    public const WIMBLEDON = 'wimbledon';
    public const US_OPEN = 'us-open';
    public const AUSTRALIAN_OPEN = 'australian-open';

    public function setContainer(ContainerInterface $container = null)
    {
        $this->container = $container;
    }

    /**
     * {@inheritDoc}
     */

    public function load(ObjectManager $manager)
    {
        $tournament = new Tournament();
        $tournament->setName("Roland Garros");
        $tournament->setSurfaceType($this->getReference(SurfaceTypeFixtures::TERRE_BATTUE));
        $tournament->setStartDate(new \DateTime('2018-02-28'));
        $tournament->setLocation('Paris');
        $tournament->setNumberOfRounds(5);
        $manager->persist($tournament);
        $this->addReference(self::ROLAND_GARROS, $tournament);

        $tournament = new Tournament();
        $tournament->setName("Wimbledon");
        $tournament->setSurfaceType($this->getReference(SurfaceTypeFixtures::GAZON));
        $tournament->setStartDate(new \DateTime('2018-05-28'));
        $tournament->setLocation('Royaume-Uni');
        $tournament->setNumberOfRounds(5);
        $manager->persist($tournament);
        $this->addReference(self::WIMBLEDON, $tournament);

        $tournament = new Tournament();
        $tournament->setName("US Open");
        $tournament->setSurfaceType($this->getReference(SurfaceTypeFixtures::DUR));
        $tournament->setStartDate(new \DateTime('2018-08-28'));
        $tournament->setLocation('Etats-Unis');
        $tournament->setNumberOfRounds(5);
        $manager->persist($tournament);
        $this->addReference(self::US_OPEN, $tournament);

        $tournament = new Tournament();
        $tournament->setName("Open d'Australie");
        $tournament->setSurfaceType($this->getReference(SurfaceTypeFixtures::DUR));
        $tournament->setStartDate(new \DateTime('2018-12-28'));
        $tournament->setLocation('Australie');
        $tournament->setNumberOfRounds(5);
        $manager->persist($tournament);
        $this->addReference(self::AUSTRALIAN_OPEN, $tournament);

        $manager->flush();
    }


    public function getOrder()
    {
        return 7;
    }
}