<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * GameStat
 *
 * @ORM\Table(name="game_stat")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\GameStatRepository")
 */
class GameStat
{
    /**
     * @var int
     *
     * @ORM\Column(name="idGameStat", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var GameScore
     *
     * @ORM\ManyToOne(targetEntity="GameScore")
     * @ORM\JoinColumn(name="gameScore_id", referencedColumnName="idGameScore", onDelete="cascade")
     */
    private $gameScore;

    /**
     * @var Stat
     *
     * @ORM\ManyToOne(targetEntity="Stat")
     * @ORM\JoinColumn(name="stat_id", referencedColumnName="idStat")
     */
    private $stat;

    /**
     * @var Registration
     *
     * @ORM\ManyToOne(targetEntity="Registration")
     * @ORM\JoinColumn(name="registration_id", referencedColumnName="idRegistration")
     */
    private $registration;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="datetime", type="datetime")
     */
    private $datetime;


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
     * Set gameScore
     *
     * @param GameScore $gameScore
     *
     * @return GameStat
     */
    public function setGameScore(GameScore $gameScore)
    {
        $this->gameScore = $gameScore;

        return $this;
    }

    /**
     * Get gameScore
     *
     * @return GameScore
     */
    public function getGameScore()
    {
        return $this->gameScore;
    }

    /**
     * Set stat
     *
     * @param Stat $stat
     *
     * @return GameStat
     */
    public function setStat(Stat $stat)
    {
        $this->stat = $stat;

        return $this;
    }

    /**
     * Get stat
     *
     * @return Stat
     */
    public function getStat()
    {
        return $this->stat;
    }

    /**
     * Set datetime
     *
     * @param \DateTime $datetime
     *
     * @return GameStat
     */
    public function setDatetime($datetime)
    {
        $this->datetime = $datetime;

        return $this;
    }

    /**
     * Get datetime
     *
     * @return \DateTime
     */
    public function getDatetime()
    {
        return $this->datetime;
    }

    /**
     * @return Registration
     */
    public function getRegistration()
    {
        return $this->registration;
    }

    /**
     * @param Registration $registration
     *
     * @return GameStat
     */
    public function setRegistration(Registration $registration)
    {
        $this->registration = $registration;

        return $this;
    }
}

