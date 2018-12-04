<?php

namespace AppBundle\DataFixtures;

use AppBundle\Entity\Country;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

class CountryFixtures extends Fixture implements OrderedFixtureInterface, ContainerAwareInterface
{
    /**
     * @var ContainerInterface
     */
    private $container;

    public const FRA_REFERENCE = 'france-country';
    public const ESP_REFERENCE = 'espagne-country';
    public const SWI_REFERENCE = 'suisse-country';
    public const GER_REFERENCE = 'allemagne-country';
    public const USA_REFERENCE = 'usa-country';
    public const CRO_REFERENCE = 'croatie-country';
    public const BUL_REFERENCE = 'bulgarie-country';
    public const AUT_REFERENCE = 'autriche-country';
    public const ARG_REFERENCE = 'argentine-country';
    public const RSA_REFERENCE = 'afrique-du-sud-country';
    public const SRB_REFERENCE = 'serbie-country';
    public const CZE_REFERENCE = 'cze-country';
    public const ITA_REFERENCE = 'italie-country';
    public const AUS_REFERENCE = 'australie-country';
    public const GBR_REFERENCE = 'royaume-uni-country';
    public const JPN_REFERENCE = 'japon-country';
    public const KOR_REFERENCE = 'coree-country';
    public const LUX_REFERENCE = 'luxembourg-country';
    public const BIH_REFERENCE = 'boznie-country';
    public const URU_REFERENCE = 'uruguay-country';
    public const CAN_REFERENCE = 'canada-country';
    public const RUS_REFERENCE = 'russie-country';
    public const UKR_REFERENCE = 'ukraine-country';
    public const CHI_REFERENCE = 'chilie-country';
    public const HUN_REFERENCE = 'hongrie-country';
    public const ROU_REFERENCE = 'roumanie-country';

    public function setContainer(ContainerInterface $container = null)
    {
        $this->container = $container;
    }

    /**
     * {@inheritDoc}
     */

    public function load(ObjectManager $manager)
    {
        $country = new Country();
        $country->setCountryName("France");
        $country->setCode("FRA");
        $manager->persist($country);
        $this->addReference(self::FRA_REFERENCE, $country);

        $country = new Country();
        $country->setCountryName("Espagne");
        $country->setCode("ESP");
        $manager->persist($country);
        $this->addReference(self::ESP_REFERENCE, $country);

        $country = new Country();
        $country->setCountryName("Suisse");
        $country->setCode("SWI");
        $manager->persist($country);
        $this->addReference(self::SWI_REFERENCE, $country);

        $country = new Country();
        $country->setCountryName("Allemagne");
        $country->setCode("GER");
        $manager->persist($country);
        $this->addReference(self::GER_REFERENCE, $country);

        $country = new Country();
        $country->setCountryName("Etats-Unis");
        $country->setCode("USA");
        $manager->persist($country);
        $this->addReference(self::USA_REFERENCE, $country);

        $country = new Country();
        $country->setCountryName("Croatie");
        $country->setCode("CRO");
        $manager->persist($country);
        $this->addReference(self::CRO_REFERENCE, $country);

        $country = new Country();
        $country->setCountryName("Bulgarie");
        $country->setCode("BUL");
        $manager->persist($country);
        $this->addReference(self::BUL_REFERENCE, $country);

        $country = new Country();
        $country->setCountryName("Autriche");
        $country->setCode("AUT");
        $manager->persist($country);
        $this->addReference(self::AUT_REFERENCE, $country);

        $country = new Country();
        $country->setCountryName("Argentine");
        $country->setCode("ARG");
        $manager->persist($country);
        $this->addReference(self::ARG_REFERENCE, $country);

        $country = new Country();
        $country->setCountryName("Afrique du Sud");
        $country->setCode("RSA");
        $manager->persist($country);
        $this->addReference(self::RSA_REFERENCE, $country);

        $country = new Country();
        $country->setCountryName("Serbie");
        $country->setCode("SRB");
        $manager->persist($country);
        $this->addReference(self::SRB_REFERENCE, $country);

        $country = new Country();
        $country->setCountryName("République tchèque");
        $country->setCode("CZE");
        $manager->persist($country);
        $this->addReference(self::CZE_REFERENCE, $country);

        $country = new Country();
        $country->setCountryName("Italie");
        $country->setCode("ITA");
        $manager->persist($country);
        $this->addReference(self::ITA_REFERENCE, $country);

        $country = new Country();
        $country->setCountryName("Australie");
        $country->setCode("AUS");
        $manager->persist($country);
        $this->addReference(self::AUS_REFERENCE, $country);

        $country = new Country();
        $country->setCountryName("Royaume-Uni");
        $country->setCode("GBR");
        $manager->persist($country);
        $this->addReference(self::GBR_REFERENCE, $country);

        $country = new Country();
        $country->setCountryName("Japon");
        $country->setCode("JPN");
        $manager->persist($country);
        $this->addReference(self::JPN_REFERENCE, $country);

        $country = new Country();
        $country->setCountryName("Corée du Sud");
        $country->setCode("KOR");
        $manager->persist($country);
        $this->addReference(self::KOR_REFERENCE, $country);

        $country = new Country();
        $country->setCountryName("Luxembourg");
        $country->setCode("LUX");
        $manager->persist($country);
        $this->addReference(self::LUX_REFERENCE, $country);

        $country = new Country();
        $country->setCountryName("Bosnie-Herzégovine");
        $country->setCode("BIH");
        $manager->persist($country);
        $this->addReference(self::BIH_REFERENCE, $country);

        $country = new Country();
        $country->setCountryName("Uruguay");
        $country->setCode("URU");
        $manager->persist($country);
        $this->addReference(self::URU_REFERENCE, $country);

        $country = new Country();
        $country->setCountryName("Canada");
        $country->setCode("CAN");
        $manager->persist($country);
        $this->addReference(self::CAN_REFERENCE, $country);

        $country = new Country();
        $country->setCountryName("Russie");
        $country->setCode("RUS");
        $manager->persist($country);
        $this->addReference(self::RUS_REFERENCE, $country);

        $country = new Country();
        $country->setCountryName("Ukraine");
        $country->setCode("UKR");
        $manager->persist($country);
        $this->addReference(self::UKR_REFERENCE, $country);

        $country = new Country();
        $country->setCountryName("Chilie");
        $country->setCode("CHI");
        $manager->persist($country);
        $this->addReference(self::CHI_REFERENCE, $country);

        $country = new Country();
        $country->setCountryName("Hongrie");
        $country->setCode("HUN");
        $manager->persist($country);
        $this->addReference(self::HUN_REFERENCE, $country);

        $country = new Country();
        $country->setCountryName("Roumanie");
        $country->setCode("ROU");
        $manager->persist($country);
        $this->addReference(self::ROU_REFERENCE, $country);

        $manager->flush();
    }


    public function getOrder()
    {
        return 5;
    }
}