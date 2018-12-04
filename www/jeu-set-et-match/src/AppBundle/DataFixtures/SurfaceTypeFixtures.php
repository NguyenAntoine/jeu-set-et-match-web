<?php

namespace AppBundle\DataFixtures;

use AppBundle\Entity\SurfaceType;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

class SurfaceTypeFixtures extends Fixture implements OrderedFixtureInterface, ContainerAwareInterface
{
    /**
     * @var ContainerInterface
     */
    private $container;

    public const DUR = 'dur';
    public const GAZON = 'gazon';
    public const MOQUETTE = 'moquette';
    public const PARQUET = 'parquet';
    public const SYNTHETIQUE = 'synthetique';
    public const TERRE_BATTUE = 'terre-battue';

    public function setContainer(ContainerInterface $container = null)
    {
        $this->container = $container;
    }

    /**
     * {@inheritDoc}
     */

    public function load(ObjectManager $manager)
    {
        $surfaceType = new SurfaceType();
        $surfaceType->setSurfaceType("Dur");
        $manager->persist($surfaceType);
        $this->addReference(self::DUR, $surfaceType);

        $surfaceType = new SurfaceType();
        $surfaceType->setSurfaceType("Gazon");
        $manager->persist($surfaceType);
        $this->addReference(self::GAZON, $surfaceType);

        $surfaceType = new SurfaceType();
        $surfaceType->setSurfaceType("Moquette");
        $manager->persist($surfaceType);
        $this->addReference(self::MOQUETTE, $surfaceType);

        $surfaceType = new SurfaceType();
        $surfaceType->setSurfaceType("Parquet");
        $manager->persist($surfaceType);
        $this->addReference(self::PARQUET, $surfaceType);

        $surfaceType = new SurfaceType();
        $surfaceType->setSurfaceType("Synthétique");
        $manager->persist($surfaceType);
        $this->addReference(self::SYNTHETIQUE, $surfaceType);

        $surfaceType = new SurfaceType();
        $surfaceType->setSurfaceType("Terre Battue");
        $manager->persist($surfaceType);
        $this->addReference(self::TERRE_BATTUE, $surfaceType);

        $manager->flush();
    }


    public function getOrder()
    {
        return 2;
    }
}