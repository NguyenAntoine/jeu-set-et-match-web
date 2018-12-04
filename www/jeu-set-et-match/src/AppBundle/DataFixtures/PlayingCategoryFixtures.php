<?php

namespace AppBundle\DataFixtures;

use AppBundle\Entity\PlayingCategory;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

class PlayingCategoryFixtures extends Fixture implements OrderedFixtureInterface, ContainerAwareInterface
{
    /**
     * @var ContainerInterface
     */
    private $container;

    public const SIMPLE_HOMMES = 'simple-hommes';
    public const SIMPLE_FEMMES = 'simple-femmes';
    public const DOUBLE_HOMMES = 'double-hommes';
    public const DOUBLE_FEMMES = 'double-femmes';
    public const DOUBLE_MIXTE = 'double-mixte';

    public function setContainer(ContainerInterface $container = null)
    {
        $this->container = $container;
    }

    /**
     * {@inheritDoc}
     */

    public function load(ObjectManager $manager)
    {
        $playingCategory = new PlayingCategory();
        $playingCategory->setCategoryName("Simple Hommes");
        $manager->persist($playingCategory);
        $this->addReference(self::SIMPLE_HOMMES, $playingCategory);

        $playingCategory = new PlayingCategory();
        $playingCategory->setCategoryName("Simple Femmes");
        $manager->persist($playingCategory);
        $this->addReference(self::SIMPLE_FEMMES, $playingCategory);

        $playingCategory = new PlayingCategory();
        $playingCategory->setCategoryName("Double Hommes");
        $manager->persist($playingCategory);
        $this->addReference(self::DOUBLE_HOMMES, $playingCategory);

        $playingCategory = new PlayingCategory();
        $playingCategory->setCategoryName("Double Femmes");
        $manager->persist($playingCategory);
        $this->addReference(self::DOUBLE_FEMMES, $playingCategory);

        $playingCategory = new PlayingCategory();
        $playingCategory->setCategoryName("Double Mixte");
        $manager->persist($playingCategory);
        $this->addReference(self::DOUBLE_MIXTE, $playingCategory);

        $manager->flush();
    }


    public function getOrder()
    {
        return 3;
    }
}