<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * FixtureResult
 *
 * @ORM\Table(name="fixture_result")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\FixtureResultRepository")
 */
class FixtureResult
{
    /**
     * @var int
     *
     * @ORM\Column(name="idFixtureResult", type="integer")
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
     * @var Registration
     *
     * @ORM\ManyToOne(targetEntity="Registration")
     * @ORM\JoinColumn(name="winnerRegistration_id", referencedColumnName="idRegistration")
     */
    private $winner;


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
     * @return FixtureResult
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
     * Set winner
     *
     * @param Registration $winner
     *
     * @return FixtureResult
     */
    public function setWinner(Registration $winner)
    {
        $this->winner = $winner;

        return $this;
    }

    /**
     * Get winner
     *
     * @return Registration
     */
    public function getWinner()
    {
        return $this->winner;
    }
}

