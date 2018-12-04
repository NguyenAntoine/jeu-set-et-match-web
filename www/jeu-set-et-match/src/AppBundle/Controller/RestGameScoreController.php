<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Fixture;
use AppBundle\Entity\GameScore;
use AppBundle\Entity\Registration;
use AppBundle\Entity\SetScore;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use FOS\RestBundle\Controller\Annotations\Post;
use FOS\RestBundle\Controller\Annotations\View;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Component\HttpFoundation\Response;

class RestGameScoreController extends Controller
{
    /**
     * @View()
     * @Post("/rest/fixtures/{id}/gameScores/{id_registration}", name="_rest_fixture_start_match")
     * @ParamConverter("registration", class="AppBundle:Registration", options={"id" = "id_registration"})
     */
    public function postFixturesGameScoresAction(Fixture $fixture, Registration $registration, EntityManagerInterface $em)
    {
        $set_score_repository = $em->getRepository(SetScore::class);
        /** @var SetScore $set_score */
        $set_score = $set_score_repository->findOneByFixture($fixture, ['id' => 'DESC']);

        $game_score_repository = $em->getRepository(GameScore::class);
        /** @var GameScore $game_score */
        $game_score = $game_score_repository->findOneBySetScore($set_score, ['id' => 'DESC']);

        if ($fixture->getFirstRegistration() === $game_score->getPlayerServing()) {
            $playerServing = $fixture->getSecondRegistration();
        } else {
            $playerServing = $fixture->getFirstRegistration();
        }

        $gameScore = new GameScore();
        $gameScore->setGameNumber($game_score->getGameNumber())
            ->setSetScore($game_score->getSetScore())
            ->setPlayerServing($game_score->getPlayerServing());

        if ($fixture->getFirstRegistration() === $registration) {
            $gameScore->setFirstRegistrationPoint($game_score->getFirstRegistrationPoint() + 1)
                ->setSecondRegistrationPoint($game_score->getSecondRegistrationPoint());
        } else {
            $gameScore->setFirstRegistrationPoint($game_score->getFirstRegistrationPoint())
                ->setSecondRegistrationPoint($game_score->getSecondRegistrationPoint() + 1);
        }
        $em->persist($gameScore);

        if ($gameScore->isGameWin()) {
            $setScore = new SetScore();
            $setScore->setFixture($fixture)
                ->setSetNumber($set_score->getSetNumber());
            if ($fixture->getFirstRegistration() === $registration) {
                $setScore->setFirstRegistrationGames($set_score->getFirstRegistrationGames() + 1)
                    ->setSecondRegistrationGames($set_score->getSecondRegistrationGames());
            } else {
                $setScore->setFirstRegistrationGames($set_score->getFirstRegistrationGames())
                    ->setSecondRegistrationGames($set_score->getSecondRegistrationGames() + 1);
            }
            $em->persist($setScore);

            $gameScore = new GameScore();
            $gameScore->setGameNumber($game_score->getGameNumber() + 1)
                ->setSetScore($setScore)
                ->setPlayerServing($playerServing->getId())
                ->setFirstRegistrationPoint(0)
                ->setSecondRegistrationPoint(0);
            $em->persist($gameScore);

            if ($setScore->isSetWin()) {
                $setScore = new SetScore();
                $setScore->setFixture($fixture)
                    ->setSetNumber($set_score->getSetNumber() + 1)
                    ->setFirstRegistrationGames(0)
                    ->setSecondRegistrationGames(0);
                $em->persist($setScore);

                $gameScore = new GameScore();
                $gameScore->setGameNumber(1)
                    ->setSetScore($setScore)
                    ->setPlayerServing($playerServing->getId())
                    ->setFirstRegistrationPoint(0)
                    ->setSecondRegistrationPoint(0);
                $em->persist($gameScore);
            }
        }

        $em->flush();

        return new Response('', Response::HTTP_OK);
    }


}