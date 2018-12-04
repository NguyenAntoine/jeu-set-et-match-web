<?php

namespace AppBundle\DataFixtures;

use AppBundle\Entity\Stat;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

class StatFixtures extends Fixture implements OrderedFixtureInterface, ContainerAwareInterface
{
    /**
     * @var ContainerInterface
     */
    private $container;

    public const ACE = 'ace';
    public const MATCH_POINT = 'match-point';
    public const SET_POINT = 'set-point';
    public const GAME_POINT = 'game-point';
    public const GAME_BREAK = 'game-break';
    public const SERVICE_FAULT = 'service-fault';
    public const GAME_FAULT = 'game-fault';
    public const CALL_MEDIC = 'call-medic';

    public function setContainer(ContainerInterface $container = null)
    {
        $this->container = $container;
    }

    /**
     * {@inheritDoc}
     */

    public function load(ObjectManager $manager)
    {
        $stat = new Stat();
        $stat->setName("Ace");
        $manager->persist($stat);
        $this->addReference(self::ACE, $stat);

        $stat = new Stat();
        $stat->setName("Balle de match");
        $manager->persist($stat);
        $this->addReference(self::MATCH_POINT, $stat);

        $stat = new Stat();
        $stat->setName("Balle de set");
        $manager->persist($stat);
        $this->addReference(self::SET_POINT, $stat);

        $stat = new Stat();
        $stat->setName("Balle de jeu");
        $manager->persist($stat);
        $this->addReference(self::GAME_POINT, $stat);

        $stat = new Stat();
        $stat->setName("Balle de break");
        $manager->persist($stat);
        $this->addReference(self::GAME_BREAK, $stat);

        $stat = new Stat();
        $stat->setName("Faute de service");
        $manager->persist($stat);
        $this->addReference(self::SERVICE_FAULT, $stat);

        $stat = new Stat();
        $stat->setName("Faute directe");
        $manager->persist($stat);
        $this->addReference(self::GAME_FAULT, $stat);

        $stat = new Stat();
        $stat->setName("Appel soigneurs");
        $manager->persist($stat);
        $this->addReference(self::CALL_MEDIC, $stat);

        $manager->flush();
    }


    public function getOrder()
    {
        return 4;
    }
}