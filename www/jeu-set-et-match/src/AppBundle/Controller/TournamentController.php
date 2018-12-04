<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Tournament;
use Doctrine\ORM\EntityManagerInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class TournamentController extends Controller
{
    /**
     * @Route("/", name="tournaments")
     */
    public function indexAction(EntityManagerInterface $em)
    {
        $tournament_repository = $em->getRepository(Tournament::class);
        $tournaments = $tournament_repository->findAll();

        return $this->render('tournament/index.html.twig', [
            'tournaments'   => $tournaments,
        ]);
    }
}
