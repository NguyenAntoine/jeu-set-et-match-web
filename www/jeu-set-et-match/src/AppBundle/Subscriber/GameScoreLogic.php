<?php

namespace AppBundle\Subscriber;

use AppBundle\Entity\GameScore;
use Doctrine\Common\EventSubscriber;
use Doctrine\ORM\Event\LifecycleEventArgs;
use Gos\Bundle\WebSocketBundle\Pusher\Wamp\WampPusher;

class GameScoreLogic implements EventSubscriber
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

        if ($entity instanceof GameScore) {
            /** @var GameScore $entity */

            $set = $entity->getSetScore();

            $this->pusher->push(
                [
                    "firstPlayerPoint" => $entity->getFirstPoint(),
                    "secondPlayerPoint" => $entity->getSecondPoint(),
                    "firstSetPlayer" => $set->getFirstRegistrationGames(),
                    "secondSetPlayer" => $set->getSecondRegistrationGames(),
                    "isSetWin" => $set->isSetWin(),
                ],
                'fixture_topic',
                ["id_fixture" => $entity->getSetScore()->getFixture()->getId()]);

        }
    }

}