<?php

namespace AppBundle\DataFixtures;

use AppBundle\Entity\RegistrationPlayer;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

class RegistrationPlayerFixtures extends Fixture implements OrderedFixtureInterface, ContainerAwareInterface
{
    /**
     * @var ContainerInterface
     */
    private $container;

    public const REGISTRATION_FEDERER = 'registration-federer';
    public const REGISTRATION_NADAL = 'registration-nadal';

    public function setContainer(ContainerInterface $container = null)
    {
        $this->container = $container;
    }

    /**
     * {@inheritDoc}
     */

    public function load(ObjectManager $manager)
    {
        $registration = new RegistrationPlayer();
        $registration->setPlayer($this->getReference(PlayerFixtures::ROGER_FEDERER));
        $registration->setRegistration($this->getReference(RegistrationFixtures::GROUPE_FEDERER));
        $manager->persist($registration);
        $this->addReference(self::REGISTRATION_FEDERER, $registration);

        $registration = new RegistrationPlayer();
        $registration->setPlayer($this->getReference(PlayerFixtures::RAFEAL_NADAL));
        $registration->setRegistration($this->getReference(RegistrationFixtures::GROUPE_NADAL));
        $manager->persist($registration);
        $this->addReference(self::REGISTRATION_NADAL, $registration);

        $manager->flush();
    }


    public function getOrder()
    {
        return 11;
    }
}