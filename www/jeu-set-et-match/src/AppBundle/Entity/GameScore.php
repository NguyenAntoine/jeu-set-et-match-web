<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * GameScore
 *
 * @ORM\Table(name="game_score")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\GameScoreRepository")
 */
class GameScore
{
    /**
     * @var int
     *
     * @ORM\Column(name="idGameScore", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var SetScore
     *
     * @ORM\ManyToOne(targetEntity="SetScore")
     * @ORM\JoinColumn(name="setScore_id", referencedColumnName="idSetScore", onDelete="cascade")
     */
    private $setScore;

    /**
     * @var int
     *
     * @ORM\Column(name="gameNumber", type="integer")
     */
    private $gameNumber;

    /**
     * @var int
     *
     * @ORM\Column(name="firstRegistrationPoint", type="integer")
     */
    private $firstRegistrationPoint;

    /**
     * @var int
     *
     * @ORM\Column(name="secondRegistrationPoint", type="integer")
     */
    private $secondRegistrationPoint;

    /**
     * @var int
     *
     * @ORM\Column(name="playerServing", type="integer")
     */
    private $playerServing;

    public function __toString()
    {
        return "Game n°" . $this->gameNumber;
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
     * @return SetScore
     */
    public function getSetScore()
    {
        return $this->setScore;
    }

    /**
     * @param SetScore $setScore
     *
     * @return GameScore
     */
    public function setSetScore(SetScore $setScore): GameScore
    {
        $this->setScore = $setScore;

        return $this;
    }

    /**
     * Set gameNumber
     *
     * @param integer $gameNumber
     *
     * @return GameScore
     */
    public function setGameNumber($gameNumber)
    {
        $this->gameNumber = $gameNumber;

        return $this;
    }

    /**
     * Get gameNumber
     *
     * @return int
     */
    public function getGameNumber()
    {
        return $this->gameNumber;
    }

    /**
     * Set firstRegistrationPoint
     *
     * @param integer $firstRegistrationPoint
     *
     * @return GameScore
     */
    public function setFirstRegistrationPoint($firstRegistrationPoint)
    {
        $this->firstRegistrationPoint = $firstRegistrationPoint;

        return $this;
    }

    /**
     * Get firstRegistrationPoint
     *
     * @return int
     */
    public function getFirstRegistrationPoint()
    {
        return $this->firstRegistrationPoint;
    }

    /**
     * Set secondRegistrationPoint
     *
     * @param integer $secondRegistrationPoint
     *
     * @return GameScore
     */
    public function setSecondRegistrationPoint($secondRegistrationPoint)
    {
        $this->secondRegistrationPoint = $secondRegistrationPoint;

        return $this;
    }

    /**
     * Get secondRegistrationPoint
     *
     * @return int
     */
    public function getSecondRegistrationPoint()
    {
        return $this->secondRegistrationPoint;
    }

    /**
     * @return int
     */
    public function getPlayerServing()
    {
        return $this->playerServing;
    }

    /**
     * @param int $playerServing
     *
     * @return GameScore
     */
    public function setPlayerServing(int $playerServing)
    {
        $this->playerServing = $playerServing;

        return $this;
    }

    public function isGameWin()
    {
        if (!$this->isGameTieBreak()) {
            if ($this->firstRegistrationPoint >= 4 || $this->secondRegistrationPoint >= 4) {
                if (abs($this->firstRegistrationPoint - $this->secondRegistrationPoint) >= 2) {
                    return true;
                }
            }
        } else {
            if ($this->firstRegistrationPoint >= 7 || $this->secondRegistrationPoint >= 7) {
                if (abs($this->firstRegistrationPoint-$this->secondRegistrationPoint) >= 2) {
                    return true;
                }
            }
        }

        return false;
    }

    public function isGameTieBreak()
    {
        if ($this->getGameNumber() == 13) {
            return true;
        }

        return false;
    }

    /**
     * Allows to transform the point from database
     * @param int $registrationPoint
     *
     * @return string
     */
    public function transformPoint(int $registrationPoint)
    {
        if ($registrationPoint >= 3) {
            return "40";
        }

        switch ($registrationPoint) {
            case 0:
                return "0";
            case 1:
                return "15";
            case 2:
                return "30";
            default:
                return "0";
        }
    }

    /**
     * Logic for first registration point
     *
     * @return string
     */
    public function getFirstPoint()
    {
        $firstPoint = $this->getFirstRegistrationPoint();

        if (!$this->isGameTieBreak()) {
            if ($this->getSecondRegistrationPoint() < $firstPoint
                && $firstPoint > 4) {
                return "A";
            } else {
                return $this->transformPoint($firstPoint);
            }
        } else {
            return strval($firstPoint);
        }
    }

    /**
     * Logic for second registration point
     *
     * @return string
     */
    public function getSecondPoint()
    {
        $secondPoint = $this->getSecondRegistrationPoint();

        if (!$this->isGameTieBreak()) {
            if ($this->getFirstRegistrationPoint() < $secondPoint
                && $secondPoint > 4) {
                return "A";
            } else {
                return $this->transformPoint($secondPoint);
            }
        } else {
            return strval($secondPoint);
        }
    }
}

