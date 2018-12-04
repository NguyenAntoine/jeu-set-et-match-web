<?php

namespace AppBundle\DataFixtures;

use AppBundle\Entity\Registration;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

class RegistrationFixtures extends Fixture implements OrderedFixtureInterface, ContainerAwareInterface
{
    /**
     * @var ContainerInterface
     */
    private $container;

    public const GROUPE_FEDERER = 'groupe-federer';
    public const GROUPE_NADAL = 'groupe-nadal';

    public function setContainer(ContainerInterface $container = null)
    {
        $this->container = $container;
    }

    /**
     * {@inheritDoc}
     */

    public function load(ObjectManager $manager)
    {
        $registration = new Registration();
        $registration->setTournamentPlayingCategory($this->getReference(TournamentPlayingCategoryFixtures::ROLAND_GARROS_SIMPLE_HOMMES));
        $manager->persist($registration);
        $this->addReference(self::GROUPE_FEDERER, $registration);

        $registration = new Registration();
        $registration->setTournamentPlayingCategory($this->getReference(TournamentPlayingCategoryFixtures::ROLAND_GARROS_SIMPLE_HOMMES));
        $manager->persist($registration);
        $this->addReference(self::GROUPE_NADAL, $registration);

        $manager->flush();
    }


    public function getOrder()
    {
        return 10;
    }
}