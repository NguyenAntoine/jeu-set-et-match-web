<?php

namespace AppBundle\Subscriber;

use AppBundle\Entity\GameStat;
use Doctrine\Common\EventSubscriber;
use Doctrine\ORM\Event\LifecycleEventArgs;
use Gos\Bundle\WebSocketBundle\Pusher\Wamp\WampPusher;

class GameStatLogic implements EventSubscriber
{
    /**
     * @var WampPusher $pusher
     */
    protected $pusher;

    /**
     * GameScoreLogic constructor.
     *
     * @param WampPusher $pusher
     */
    public function __construct($pusher)
    {
        $this->pusher = $pusher;
    }

    public function getSubscribedEvents()
    {
        return array(
            'postPersist',
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

        if ($entity instanceof GameStat) {
            /** @var GameStat $entity */
            $this->pusher->push(
                [
                    "registration" => $entity->getRegistration()->getName(),
                    "stat" => $entity->getStat()->getName(),
                    "datetime" => $entity->getDatetime()->format('H:i:s'),
                ],
                'fixture_topic',
                ["id_fixture" => $entity->getGameScore()->getSetScore()->getFixture()->getId()]);

        }
    }

}