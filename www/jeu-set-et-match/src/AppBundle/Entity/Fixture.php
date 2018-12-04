<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * Fixture
 *
 * @ORM\Table(name="fixture")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\FixtureRepository")
 */
class Fixture
{
    /**
     * @var int
     *
     * @Groups({"referee"})
     * @ORM\Column(name="idFixture", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var User
     *
     * @ORM\ManyToOne(targetEntity="User")
     * @ORM\JoinColumn(name="referee_id", referencedColumnName="idUser")
     */
    private $referee;

    /**
     * @var Registration
     *
     * @Groups({"referee"})
     * @ORM\ManyToOne(targetEntity="Registration")
     * @ORM\JoinColumn(name="firstRegistration_id", referencedColumnName="idRegistration")
     */
    private $firstRegistration;

    /**
     * @var Registration
     *
     * @Groups({"referee"})
     * @ORM\ManyToOne(targetEntity="Registration")
     * @ORM\JoinColumn(name="secondRegistration_id", referencedColumnName="idRegistration")
     */
    private $secondRegistration;

    /**
     * @var int
     *
     * @ORM\Column(name="round", type="integer")
     */
    private $round;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="startDate", type="datetime", nullable=true)
     */
    private $startDate;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="endDate", type="datetime", nullable=true)
     */
    private $endDate;

    /**
     * @var Court
     *
     * @ORM\ManyToOne(targetEntity="Court")
     * @ORM\JoinColumn(name="court_id", referencedColumnName="idCourt")
     */
    private $court;

    /**
     * @var TournamentPlayingCategory
     *
     * @ORM\ManyToOne(targetEntity="TournamentPlayingCategory")
     * @ORM\JoinColumn(name="tournamentPlayingCategory_id", referencedColumnName="idTournamentPlayingCategory")
     */
    private $tournamentPlayingCategory;

    /**
     * @return string
     */
    public function __toString()
    {
        return $this->firstRegistration . ' vs ' . $this->secondRegistration;
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
     * Set court
     *
     * @param Court $court
     *
     * @return Fixture
     */
    public function setCourt(Court $court)
    {
        $this->court = $court;

        return $this;
    }

    /**
     * Get court
     *
     * @return Court
     */
    public function getCourt()
    {
        return $this->court;
    }

    /**
     * Set referee
     *
     * @param User $referee
     *
     * @return Fixture
     */
    public function setReferee(User $referee)
    {
        $this->referee = $referee;

        return $this;
    }

    /**
     * Get referee
     *
     * @return User
     */
    public function getReferee()
    {
        return $this->referee;
    }

    /**
     * Set firstRegistration
     *
     * @param Registration $firstRegistration
     *
     * @return Fixture
     */
    public function setFirstRegistration(Registration $firstRegistration)
    {
        $this->firstRegistration = $firstRegistration;

        return $this;
    }

    /**
     * Get firstRegistration
     *
     * @return Registration
     */
    public function getFirstRegistration()
    {
        return $this->firstRegistration;
    }

    /**
     * Set secondRegistration
     *
     * @param Registration $secondRegistration
     *
     * @return Fixture
     */
    public function setSecondRegistration(Registration $secondRegistration)
    {
        $this->secondRegistration = $secondRegistration;

        return $this;
    }

    /**
     * Get secondRegistration
     *
     * @return Registration
     */
    public function getSecondRegistration()
    {
        return $this->secondRegistration;
    }

    /**
     * Set round
     *
     * @param integer $round
     *
     * @return Fixture
     */
    public function setRound($round)
    {
        $this->round = $round;

        return $this;
    }

    /**
     * Get round
     *
     * @return int
     */
    public function getRound()
    {
        return $this->round;
    }

    /**
     * @return \DateTime
     */
    public function getStartDate()
    {
        return $this->startDate;
    }

    /**
     * @param \DateTime $startDate
     *
     * @return Fixture
     */
    public function setStartDate(\DateTime $startDate)
    {
        $this->startDate = $startDate;

        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getEndDate()
    {
        return $this->endDate;
    }

    /**
     * @param \DateTime $endDate
     *
     * @return Fixture
     */
    public function setEndDate(\DateTime $endDate)
    {
        $this->endDate = $endDate;

        return $this;
    }

    /**
     * @return TournamentPlayingCategory
     */
    public function getTournamentPlayingCategory()
    {
        return $this->tournamentPlayingCategory;
    }

    /**
     * @param TournamentPlayingCategory $tournamentPlayingCategory
     *
     * @return Fixture
     */
    public function setTournamentPlayingCategory(TournamentPlayingCategory $tournamentPlayingCategory)
    {
        $this->tournamentPlayingCategory = $tournamentPlayingCategory;

        return $this;
    }
}
