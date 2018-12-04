<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Fixture;
use AppBundle\Entity\FixtureResult;
use AppBundle\Entity\GameScore;
use AppBundle\Entity\GameStat;
use AppBundle\Entity\RegistrationPlayer;
use AppBundle\Entity\SetScore;
use AppBundle\Entity\Tournament;
use AppBundle\Entity\TournamentPlayingCategory;
use AppBundle\Repository\SetScoreRepository;
use AppBundle\Repository\TournamentPlayingCategoryRepository;
use Doctrine\ORM\EntityManagerInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class FixtureController extends Controller
{
    /**
     * @Route("/fixtures/{idTournament}/", name="fixtures")
     * @ParamConverter("tournament", options={"mapping": {"idTournament": "id"}})
     */
    public function viewAllFixtureAction(Tournament $tournament = null, EntityManagerInterface $em)
    {
        if (empty($tournament)) {
            $this->addFlash(
                'danger',
                "Le tournoi n'existe pas!"
            );

            return $this->redirectToRoute('tournaments');
        }

        $tournament_playing_category_repository = $em->getRepository(TournamentPlayingCategory::class);
        $tournament_playing_category = $tournament_playing_category_repository->findByTournament($tournament);

        $fixture_repository = $em->getRepository(Fixture::class);
        $fixtures = $fixture_repository->findBy(['tournamentPlayingCategory' => $tournament_playing_category]);

        return $this->render('fixture/viewAllFixture.html.twig', [
            'tournament' => $tournament,
            'fixtures' => $fixtures,
        ]);
    }

    /**
     * @Route("/fixture/{idFixture}/", name="fixture")
     * @ParamConverter("fixture", options={"mapping": {"idFixture": "id"}})
     */
    public function viewFixtureAction(Fixture $fixture = null, EntityManagerInterface $em)
    {
        if (empty($fixture)) {
            $this->addFlash(
                'danger',
                "Le match n'existe pas!"
            );

            return $this->redirectToRoute('tournaments');
        }
        $registration_player_repository = $em->getRepository(RegistrationPlayer::class);
        $firstRegistrationPlayer = $registration_player_repository->findByRegistration($fixture->getFirstRegistration());
        $secondRegistrationPlayer = $registration_player_repository->findByRegistration($fixture->getSecondRegistration());

        /** @var SetScoreRepository $set_score_repository */
        $set_score_repository = $em->getRepository(SetScore::class);

        $count = $set_score_repository->getNb();
        if ("1" === $count) {
            $set_score = $set_score_repository->findOneByFixture($fixture);
            $array_setScore[] = $set_score;
        } else {
            $set_score = $set_score_repository->findLastBySetNumber($fixture);

            foreach ($set_score as $set) {
                $array_setScore[] = $set_score_repository->find(array_values($set)[0]);
            }
        }

        $last_set_score = end($array_setScore);

        $game_score_repository = $em->getRepository(GameScore::class);
        $gameScore = $game_score_repository->findBySetScore($last_set_score);

        /** @var GameScore $last_game_score */
        $last_game_score = end($gameScore);

        $game_stat_repository = $em->getRepository(GameStat::class);
        $gameStat = $game_stat_repository->findByGameScore($gameScore);

        $fixture_result_repository = $em->getRepository(FixtureResult::class);
        $fixtureResult = $fixture_result_repository->findOneByFixture($fixture);

        $firstPlayerPoint = $last_game_score->getFirstPoint();
        $secondPlayerPoint = $last_game_score->getSecondPoint();

        $startDate = $fixture->getStartDate();
        if ($startDate) {
            $timestamp = $fixture->getStartDate()->format("c");
        } else {
            $timestamp = null;
        }

        return $this->render('fixture/viewFixture.html.twig', [
            'fixtureId' => $fixture->getId(),
            'firstPlayers' => $firstRegistrationPlayer,
            'secondPlayers' => $secondRegistrationPlayer,
            'setScore' => $array_setScore,
            'firstPlayerPoint' => $firstPlayerPoint,
            'secondPlayerPoint' => $secondPlayerPoint,
            'gameStat' => $gameStat,
            'time' => $timestamp,
            'fixtureResult' => $fixtureResult,
        ]);
    }

}