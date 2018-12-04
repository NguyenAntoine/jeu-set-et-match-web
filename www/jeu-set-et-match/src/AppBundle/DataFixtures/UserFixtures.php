<?php

namespace AppBundle\DataFixtures;

use AppBundle\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

class UserFixtures extends Fixture implements OrderedFixtureInterface, ContainerAwareInterface
{
    /**
     * @var ContainerInterface
     */
    private $container;

    public const REFEREE_USER_REFERENCE = 'referee-user';

    public function setContainer(ContainerInterface $container = null)
    {
        $this->container = $container;
    }

    /**
     * {@inheritDoc}
     */

    public function load(ObjectManager $manager)
    {
        $userManager = $this->container->get('fos_user.user_manager');
        $userAdmin = new User();
        $userAdmin->setUsername('admin');
        $userAdmin->setPlainPassword('admin');
        $userAdmin->setEmail('admin@atp.lab.com');
        $userAdmin->setEmailCanonical('admin@atp.lab.com');
        $userAdmin->setFirstName('admin');
        $userAdmin->setLastName('admin');
        $userAdmin->setDateOfBirth(new \DateTime('1990-10-10'));
        $userAdmin->setPhoneNumber('0610467582');
        $userAdmin->setSuperAdmin(true);
        $userAdmin->setEnabled(true);
        $userAdmin->setConfirmationToken(null);
        $userManager->updateCanonicalFields($userAdmin);
        $userManager->updatePassword($userAdmin);

        $manager->persist($userAdmin);
        $this->setReference('admin-user', $userAdmin);

        $referee = new User();
        $referee->setUsername('Robert');
        $referee->setPlainPassword('robert');
        $referee->setEmail('robert@atp.lab.com');
        $referee->setEmailCanonical('robert@atp.lab.com');
        $referee->setFirstName('Robert');
        $referee->setLastName('Ocarlos');
        $referee->setDateOfBirth(new \DateTime('1990-10-10'));
        $referee->setPhoneNumber('0610445882');
        $referee->addRole('ROLE_REFEREE');
        $referee->setEnabled(true);
        $referee->setConfirmationToken(null);
        $userManager->updateCanonicalFields($referee);
        $userManager->updatePassword($referee);

        $manager->persist($referee);
        $this->addReference(self::REFEREE_USER_REFERENCE, $referee);

        $manager->flush();
    }


    public function getOrder()
    {
        return 1;
    }
}