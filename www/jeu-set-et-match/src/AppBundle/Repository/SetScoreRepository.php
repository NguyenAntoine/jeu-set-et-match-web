<?php

namespace AppBundle\Repository;

use AppBundle\Entity\Fixture;
use Doctrine\ORM\EntityRepository;

class SetScoreRepository extends EntityRepository
{
    /**
     * @param Fixture $fixture
     * @return array
     */
    public function findLastBySetNumber(Fixture $fixture)
    {
        return $this->getEntityManager()
            ->createQueryBuilder()
            ->select('MAX(s.id)')
            ->from('AppBundle:SetScore', 's')
            ->where('s.fixture = :fixture')->setParameter('fixture', $fixture)
            ->groupBy('s.setNumber')
            ->getQuery()
            ->getResult();
    }

    /**
     * @return mixed
     * @throws \Doctrine\ORM\NoResultException
     * @throws \Doctrine\ORM\NonUniqueResultException
     */
    public function getNb()
    {
        return $this->createQueryBuilder('l')
            ->select('COUNT(l)')
            ->getQuery()
            ->getSingleScalarResult();
    }
}
