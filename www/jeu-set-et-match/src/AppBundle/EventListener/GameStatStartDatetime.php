<?php

namespace AppBundle\EventListener;

use AppBundle\Entity\GameStat;
use Doctrine\ORM\Event\LifecycleEventArgs;

class GameStatStartDatetime
{
    public function prePersist(LifecycleEventArgs $args)
    {
        $entity = $args->getEntity();

        if ($entity instanceof GameStat) {
            /** @var GameStat $entity */
            $entity->setDatetime(new \DateTime());
        }
    }
}