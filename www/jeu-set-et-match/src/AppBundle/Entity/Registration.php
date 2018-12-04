<?php

namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * Registration
 *
 * @ORM\Table(name="registration")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\RegistrationRepository")
 */
class Registration
{
    /**
     * @var int
     *
     * @Groups({"referee"})
     * @ORM\Column(name="idRegistration", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var TournamentPlayingCategory
     *
     * @ORM\ManyToOne(targetEntity="TournamentPlayingCategory")
     * @ORM\JoinColumn(name="tournamentPlayingCategory_id", referencedColumnName="idTournamentPlayingCategory")
     */
    private $tournamentPlayingCategory;

    /**
     * @var ArrayCollection
     *
     * @Groups({"referee"})
     * @ORM\OneToMany(targetEntity="RegistrationPlayer", mappedBy="registration", orphanRemoval=true)
     */
    private $registrationPlayers;

    public function __construct()
    {
        $this->registrationPlayers = new ArrayCollection();
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return $this->getName();
    }

    /**
     * Get the name of players registered
     *
     * @return string
     */
    public function getName()
    {
        $registration = "";
        $registrationPlayers = $this->registrationPlayers;

        /** @var RegistrationPlayer $registrationPlayer */
        foreach ($registrationPlayers as $registrationPlayer) {
            $registration .= $registrationPlayer->getPlayer()->getName();

            if ($registrationPlayer !== $registrationPlayers->last()) {
                $registration .= ' / ';
            }
        }
        return $registration;
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
     * Set tournament playing category
     *
     * @param TournamentPlayingCategory $tournamentPlayingCategory
     *
     * @return Registration
     */
    public function setTournamentPlayingCategory(TournamentPlayingCategory $tournamentPlayingCategory)
    {
        $this->tournamentPlayingCategory = $tournamentPlayingCategory;

        return $this;
    }

    /**
     * Get tournament playing category
     *
     * @return TournamentPlayingCategory
     */
    public function getTournamentPlayingCategory()
    {
        return $this->tournamentPlayingCategory;
    }

    /**
     * @return ArrayCollection|RegistrationPlayer[]
     */
    public function getRegistrationPlayers()
    {
        return $this->registrationPlayers;
    }
}
