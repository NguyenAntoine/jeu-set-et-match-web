<?php

namespace AppBundle\Subscriber;

use AppBundle\Entity\Fixture;
use AppBundle\Entity\GameScore;
use AppBundle\Entity\SetScore;
use Doctrine\Common\EventSubscriber;
use Doctrine\ORM\Event\LifecycleEventArgs;

class FixtureLogic implements EventSubscriber
{
    public function getSubscribedEvents()
    {
        return array(
            'postPersist',
            'preUpdate',
        );
    }

    /**
     *
     * @param LifecycleEventArgs $args
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function postPersist(LifecycleEventArgs $args)
    {
        $entity = $args->getEntity();

        if ($entity instanceof Fixture) {
            $entityManager = $args->getEntityManager();

            $setScore = new SetScore();
            $setScore->setFirstRegistrationGames(0);
            $setScore->setSecondRegistrationGames(0);
            $setScore->setFixture($entity);
            $setScore->setSetNumber(1);

            $entityManager->persist($setScore);

            $gameScore = new GameScore();
            $gameScore->setFirstRegistrationPoint(0);
            $gameScore->setSecondRegistrationPoint(0);
            $gameScore->setGameNumber(1);
            $gameScore->setSetScore($setScore);
            $gameScore->setPlayerServing($entity->getFirstRegistration()->getId());

            $entityManager->persist($gameScore);

            $entityManager->flush();

        }
    }

    /**
     * Set start date before update into database
     *
     * @param LifecycleEventArgs $args
     */
    public function preUpdate(LifecycleEventArgs $args)
    {
        $entity = $args->getEntity();

        if ($entity instanceof Fixture) {
            $entity->setStartDate(new \DateTime());
        }
    }
}