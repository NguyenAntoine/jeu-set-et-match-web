<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * SurfaceType
 *
 * @ORM\Table(name="surface_type")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\SurfaceTypeRepository")
 */
class SurfaceType
{
    /**
     * @var int
     *
     * @ORM\Column(name="idSurfaceType", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="surfaceType", type="string", length=30)
     */
    private $surfaceType;

    /**
     * @return string
     */
    public function __toString()
    {
        return $this->surfaceType;
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
     * Set surfaceType
     *
     * @param string $surfaceType
     *
     * @return SurfaceType
     */
    public function setSurfaceType($surfaceType)
    {
        $this->surfaceType = $surfaceType;

        return $this;
    }

    /**
     * Get surfaceType
     *
     * @return string
     */
    public function getSurfaceType()
    {
        return $this->surfaceType;
    }
}

