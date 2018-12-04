<?php

namespace AppBundle\DataFixtures;

use AppBundle\Entity\Player;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

class PlayerFixtures extends Fixture implements OrderedFixtureInterface, ContainerAwareInterface
{
    /**
     * @var ContainerInterface
     */
    private $container;

    public const ROGER_FEDERER = 'roger-federer';
    public const RAFEAL_NADAL = 'rafael-nadal';
    public const MARIN_CILIC = 'marin-cilic';
    public const NOVAK_DJOKOVIC = 'novak-djokovic';
    public const SIMONA_HALEP = 'simona-halep';
    public const SERENA_WILLIAMS = 'serena-williams';

    public function setContainer(ContainerInterface $container = null)
    {
        $this->container = $container;
    }

    /**
     * {@inheritDoc}
     */

    public function load(ObjectManager $manager)
    {
        $player = new Player();
        $player->setFirstName("Roger");
        $player->setLastName("Federer");
        $player->setDateOfBirth(new \DateTime('1981-08-08'));
        $player->setCountry($this->getReference(CountryFixtures::SWI_REFERENCE));
        $player->setGender("M");
        $manager->persist($player);
        $this->addReference(self::ROGER_FEDERER, $player);

        $player = new Player();
        $player->setFirstName("Rafael");
        $player->setLastName("Nadal");
        $player->setDateOfBirth(new \DateTime('1986-06-03'));
        $player->setCountry($this->getReference(CountryFixtures::ESP_REFERENCE));
        $player->setGender("M");
        $manager->persist($player);
        $this->addReference(self::RAFEAL_NADAL, $player);

        $player = new Player();
        $player->setFirstName("Marin");
        $player->setLastName("Cilic");
        $player->setDateOfBirth(new \DateTime('1988-09-28'));
        $player->setCountry($this->getReference(CountryFixtures::CRO_REFERENCE));
        $player->setGender("M");
        $manager->persist($player);
        $this->addReference(self::MARIN_CILIC, $player);

        $player = new Player();
        $player->setFirstName("Novak");
        $player->setLastName("Djokovic");
        $player->setDateOfBirth(new \DateTime('1987-05-22'));
        $player->setCountry($this->getReference(CountryFixtures::SRB_REFERENCE));
        $player->setGender("M");
        $manager->persist($player);
        $this->addReference(self::NOVAK_DJOKOVIC, $player);

        $player = new Player();
        $player->setFirstName("Simona");
        $player->setLastName("Halep");
        $player->setDateOfBirth(new \DateTime('1991-09-27'));
        $player->setCountry($this->getReference(CountryFixtures::ROU_REFERENCE));
        $player->setGender("F");
        $manager->persist($player);
        $this->addReference(self::SIMONA_HALEP, $player);

        $player = new Player();
        $player->setFirstName("Serena");
        $player->setLastName("Williams");
        $player->setDateOfBirth(new \DateTime('1981-09-27'));
        $player->setCountry($this->getReference(CountryFixtures::USA_REFERENCE));
        $player->setGender("F");
        $manager->persist($player);
        $this->addReference(self::SERENA_WILLIAMS, $player);

        $manager->flush();
    }


    public function getOrder()
    {
        return 6;
    }
}