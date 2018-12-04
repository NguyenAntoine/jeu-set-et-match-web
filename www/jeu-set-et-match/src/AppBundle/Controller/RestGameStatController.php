<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Fixture;
use AppBundle\Entity\GameScore;
use AppBundle\Entity\GameStat;
use AppBundle\Entity\Registration;
use AppBundle\Entity\SetScore;
use AppBundle\Entity\Stat;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use FOS\RestBundle\Controller\Annotations\Post;
use FOS\RestBundle\Controller\Annotations\View;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Component\HttpFoundation\Response;

class RestGameStatController extends Controller
{
    /**
     * @param Fixture $fixture
     * @param EntityManagerInterface $em
     * @return GameScore
     */
    private function getGameScore(Fixture $fixture, EntityManagerInterface $em)
    {
        $set_score_repository = $em->getRepository(SetScore::class);

        $count = $set_score_repository->getNb();
        if ("1" === $count) {
            $set_score = $set_score_repository->findByFixture($fixture);
        } else {
            $set_score = $set_score_repository->findLastBySetNumber($fixture);
        }

        /** @var SetScore $last_set_score */
        $last_set_score = end($set_score);
        $game_score_repository = $em->getRepository(GameScore::class);
        $gameScore = $game_score_repository->findBySetScore($last_set_score);

        return end($gameScore);
    }

    /**
     * @View()
     * @Post("/rest/fixtures/{id}/registrations/{id_registration}/call-medic", name="_rest_game_stat_call_medic")
     * @ParamConverter("registration", class="AppBundle:Registration", options={"id" = "id_registration"})
     * @param Fixture $fixture
     * @param Registration $registration
     * @param EntityManagerInterface $em
     * @return Response
     */
    public function postGameScoresRegistrationsCallMedicAction(Fixture $fixture, Registration $registration, EntityManagerInterface $em)
    {
        $stat_repository = $em->getRepository(Stat::class);
        /** @var Stat $stat */
        $stat = $stat_repository->findOneByName('Appel soigneurs');

        $gameStat = new GameStat();
        $gameStat->setGameScore($this->getGameScore($fixture, $em))
            ->setRegistration($registration)
            ->setDatetime(new \DateTime())
            ->setStat($stat);
        $em->persist($gameStat);
        $em->flush();

        return new Response('', Response::HTTP_OK);
    }

    /**
     * @View()
     * @Post("/rest/fixtures/{id}/registrations/{id_registration}/fault-service", name="_rest_game_stat_fault_service")
     * @ParamConverter("registration", class="AppBundle:Registration", options={"id" = "id_registration"})
     * @param Fixture $fixture
     * @param Registration $registration
     * @param EntityManagerInterface $em
     * @return Response
     */
    public function postGameScoresRegistrationsFaultServiceAction(Fixture $fixture, Registration $registration, EntityManagerInterface $em)
    {
        $stat_repository = $em->getRepository(Stat::class);
        /** @var Stat $stat */
        $stat = $stat_repository->findOneByName('Faute de service');

        $gameStat = new GameStat();
        $gameStat->setGameScore($this->getGameScore($fixture, $em))
            ->setRegistration($registration)
            ->setDatetime(new \DateTime())
            ->setStat($stat);
        $em->persist($gameStat);
        $em->flush();

        return new Response('', Response::HTTP_OK);
    }

    /**
     * @View()
     * @Post("/rest/fixtures/{id}/registrations/{id_registration}/fault", name="_rest_game_stat_fault")
     * @ParamConverter("registration", class="AppBundle:Registration", options={"id" = "id_registration"})
     * @param Fixture $fixture
     * @param Registration $registration
     * @param EntityManagerInterface $em
     * @return Response
     */
    public function postGameScoresRegistrationsFaultAction(Fixture $fixture, Registration $registration, EntityManagerInterface $em)
    {
        $stat_repository = $em->getRepository(Stat::class);
        /** @var Stat $stat */
        $stat = $stat_repository->findOneByName('Faute directe');

        $gameStat = new GameStat();
        $gameStat->setGameScore($this->getGameScore($fixture, $em))
            ->setRegistration($registration)
            ->setDatetime(new \DateTime())
            ->setStat($stat);
        $em->persist($gameStat);
        $em->flush();

        return new Response('', Response::HTTP_OK);
    }

    /**
     * @View()
     * @Post("/rest/fixtures/{id}/registrations/{id_registration}/ace", name="_rest_game_stat_ace")
     * @ParamConverter("registration", class="AppBundle:Registration", options={"id" = "id_registration"})
     * @param Fixture $fixture
     * @param Registration $registration
     * @param EntityManagerInterface $em
     * @return Response
     */
    public function postGameScoresRegistrationsAceAction(Fixture $fixture, Registration $registration, EntityManagerInterface $em)
    {
        $stat_repository = $em->getRepository(Stat::class);
        /** @var Stat $stat */
        $stat = $stat_repository->findOneByName('Ace');

        $gameStat = new GameStat();
        $gameStat->setGameScore($this->getGameScore($fixture, $em))
            ->setRegistration($registration)
            ->setDatetime(new \DateTime())
            ->setStat($stat);
        $em->persist($gameStat);
        $em->flush();

        return new Response('', Response::HTTP_OK);
    }
}