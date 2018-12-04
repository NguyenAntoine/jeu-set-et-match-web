<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * Registration Player
 *
 * @ORM\Table(name="registration_player")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\RegistrationPlayerRepository")
 */
class RegistrationPlayer
{
    /**
     * @var int
     *
     * @ORM\Column(name="idRegistrationPlayer", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var Registration
     *
     * @ORM\ManyToOne(targetEntity="Registration", inversedBy="registrationPlayers")
     * @ORM\JoinColumn(name="registration_id", referencedColumnName="idRegistration")
     */
    private $registration;

    /**
     * @var Player
     *
     * @Groups({"referee"})
     * @ORM\ManyToOne(targetEntity="Player")
     * @ORM\JoinColumn(name="player_id", referencedColumnName="idPlayer")
     */
    private $player;

    /**
     * @return string
     */
    public function __toString()
    {
        return $this->player->__toString();
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
     * @return Player
     */
    public function getPlayer()
    {
        return $this->player;
    }

    /**
     * @param Player $player
     *
     * @return RegistrationPlayer
     */
    public function setPlayer(Player $player)
    {
        $this->player = $player;

        return $this;
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
     * @return RegistrationPlayer
     */
    public function setRegistration(Registration $registration)
    {
        $this->registration = $registration;

        return $this;
    }

    /**
     * @return string
     */
    public function getImageName()
    {
        return str_replace(" ", "_", strtolower($this->player->__toString()));
    }
}
