<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Doctrine
 *
 * @ORM\Table(name="doctrine")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\DoctrineRepository")
 */
class Doctrine
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;


    /**
     * @var FitCategory
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\FitCategory", inversedBy="doctrines")
     */
    private $category;


    /**
     * @var Fit
     *
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Fit", mappedBy="doctrine")
     */
    private $fits;


    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set name
     *
     * @param string $name
     *
     * @return Doctrine
     */
    public function setName($name)
    {
        $this->name = $name;
    
        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->fits = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Set category
     *
     * @param \AppBundle\Entity\FitCategory $category
     *
     * @return Doctrine
     */
    public function setCategory(\AppBundle\Entity\FitCategory $category = null)
    {
        $this->category = $category;
    
        return $this;
    }

    /**
     * Get category
     *
     * @return \AppBundle\Entity\FitCategory
     */
    public function getCategory()
    {
        return $this->category;
    }

    /**
     * Add fit
     *
     * @param \AppBundle\Entity\Fit $fit
     *
     * @return Doctrine
     */
    public function addFit(\AppBundle\Entity\Fit $fit)
    {
        $this->fits[] = $fit;
    
        return $this;
    }

    /**
     * Remove fit
     *
     * @param \AppBundle\Entity\Fit $fit
     */
    public function removeFit(\AppBundle\Entity\Fit $fit)
    {
        $this->fits->removeElement($fit);
    }

    /**
     * Get fits
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getFits()
    {
        return $this->fits;
    }
}
