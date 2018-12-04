<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * TournamentPlayingCategory
 *
 * @ORM\Table(name="tournament_playing_category")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\TournamentPlayingCategoryRepository")
 */
class TournamentPlayingCategory
{
    /**
     * @var int
     *
     * @ORM\Column(name="idTournamentPlayingCategory", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var Tournament
     *
     * @ORM\ManyToOne(targetEntity="Tournament")
     * @ORM\JoinColumn(name="tournament_id", referencedColumnName="idTournament")
     */
    private $tournament;

    /**
     * @var PlayingCategory
     *
     * @ORM\ManyToOne(targetEntity="PlayingCategory")
     * @ORM\JoinColumn(name="playingCategory_id", referencedColumnName="idPlayingCategory")
     */
    private $playingCategory;

    public function __toString()
    {
        return $this->tournament->__toString();
    }

    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set tournament
     *
     * @param Tournament $tournament
     *
     * @return TournamentPlayingCategory
     */
    public function setTournament(Tournament $tournament)
    {
        $this->tournament = $tournament;

        return $this;
    }

    /**
     * Get tournament
     *
     * @return Tournament
     */
    public function getTournament()
    {
        return $this->tournament;
    }

    /**
     * Set playingCategory
     *
     * @param PlayingCategory $playingCategory
     *
     * @return TournamentPlayingCategory
     */
    public function setPlayingCategory(PlayingCategory $playingCategory)
    {
        $this->playingCategory = $playingCategory;

        return $this;
    }

    /**
     * Get playingCategory
     *
     * @return PlayingCategory
     */
    public function getPlayingCategory()
    {
        return $this->playingCategory;
    }
}

