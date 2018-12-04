<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * SetScore
 *
 * @ORM\Table(name="set_score")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\SetScoreRepository")
 */
class SetScore
{
    /**
     * @var int
     *
     * @ORM\Column(name="idSetScore", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var Fixture
     *
     * @ORM\ManyToOne(targetEntity="Fixture")
     * @ORM\JoinColumn(name="fixture_id", referencedColumnName="idFixture", onDelete="cascade")
     */
    private $fixture;

    /**
     * @var int
     *
     * @ORM\Column(name="setNumber", type="integer")
     */
    private $setNumber;

    /**
     * @var int
     *
     * @ORM\Column(name="firstRegistrationGames", type="integer")
     */
    private $firstRegistrationGames;

    /**
     * @var int
     *
     * @ORM\Column(name="secondRegistrationGames", type="integer")
     */
    private $secondRegistrationGames;

    /**
     * @return string
     */
    public function __toString()
    {
        return strval($this->setNumber);
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
     * Set fixture
     *
     * @param Fixture $fixture
     *
     * @return SetScore
     */
    public function setFixture(Fixture $fixture)
    {
        $this->fixture = $fixture;

        return $this;
    }

    /**
     * Get fixture
     *
     * @return Fixture
     */
    public function getFixture()
    {
        return $this->fixture;
    }

    /**
     * Set setNumber
     *
     * @param integer $setNumber
     *
     * @return SetScore
     */
    public function setSetNumber($setNumber)
    {
        $this->setNumber = $setNumber;

        return $this;
    }

    /**
     * Get setNumber
     *
     * @return int
     */
    public function getSetNumber()
    {
        return $this->setNumber;
    }

    /**
     * Set firstRegistrationGames
     *
     * @param integer $firstRegistrationGames
     *
     * @return SetScore
     */
    public function setFirstRegistrationGames($firstRegistrationGames)
    {
        $this->firstRegistrationGames = $firstRegistrationGames;

        return $this;
    }

    /**
     * Get firstRegistrationGames
     *
     * @return int
     */
    public function getFirstRegistrationGames()
    {
        return $this->firstRegistrationGames;
    }

    /**
     * Set secondRegistrationGames
     *
     * @param integer $secondRegistrationGames
     *
     * @return SetScore
     */
    public function setSecondRegistrationGames($secondRegistrationGames)
    {
        $this->secondRegistrationGames = $secondRegistrationGames;

        return $this;
    }

    /**
     * Get secondRegistrationGames
     *
     * @return int
     */
    public function getSecondRegistrationGames()
    {
        return $this->secondRegistrationGames;
    }

    public function isSetWin()
    {
        if ($this->firstRegistrationGames >= 6 || $this->secondRegistrationGames >= 6) {
            if ((abs($this->firstRegistrationGames-$this->secondRegistrationGames) >= 2)
                || ($this->firstRegistrationGames == 7 || $this->secondRegistrationGames == 7)) {
                return true;
            }
        }

        return false;
    }
}

