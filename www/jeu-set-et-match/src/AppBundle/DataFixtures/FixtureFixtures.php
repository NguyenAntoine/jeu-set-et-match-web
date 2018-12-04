<?php

namespace AppBundle\DataFixtures;

use AppBundle\Entity\Fixture;
use Doctrine\Bundle\FixturesBundle\Fixture as Fixtures;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

class FixtureFixtures extends Fixtures implements OrderedFixtureInterface, ContainerAwareInterface
{
    /**
     * @var ContainerInterface
     */
    private $container;
    public const FIXTURE_FEDERER_VS_NADAL = 'fixture-1';

    public function setContainer(ContainerInterface $container = null)
    {
        $this->container = $container;
    }

    /**
     * {@inheritDoc}
     */

    public function load(ObjectManager $manager)
    {
        $fixture = new Fixture();
        $fixture->setTournamentPlayingCategory($this->getReference(TournamentPlayingCategoryFixtures::ROLAND_GARROS_SIMPLE_HOMMES));
        $fixture->setCourt($this->getReference(CourtFixtures::COURT_1));
        $fixture->setFirstRegistration($this->getReference(RegistrationFixtures::GROUPE_FEDERER));
        $fixture->setSecondRegistration($this->getReference(RegistrationFixtures::GROUPE_NADAL));
        $fixture->setReferee($this->getReference(UserFixtures::REFEREE_USER_REFERENCE));
        $fixture->setRound(1);
        $manager->persist($fixture);
        $this->addReference(self::FIXTURE_FEDERER_VS_NADAL, $fixture);

        $manager->flush();
    }


    public function getOrder()
    {
        return 12;
    }
}