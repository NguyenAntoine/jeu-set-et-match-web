<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * PlayingCategory
 *
 * @ORM\Table(name="playing_category")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\PlayingCategoryRepository")
 */
class PlayingCategory
{
    /**
     * @var int
     *
     * @ORM\Column(name="idPlayingCategory", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="categoryName", type="string", length=45)
     */
    private $categoryName;

    public function __toString()
    {
        return $this->categoryName;
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
     * Set categoryName
     *
     * @param string $categoryName
     *
     * @return PlayingCategory
     */
    public function setCategoryName($categoryName)
    {
        $this->categoryName = $categoryName;

        return $this;
    }

    /**
     * Get categoryName
     *
     * @return string
     */
    public function getCategoryName()
    {
        return $this->categoryName;
    }
}

