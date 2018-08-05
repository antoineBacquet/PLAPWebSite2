<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Fit
 *
 * @ORM\Table(name="fit")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\FitRepository")
 */
class Fit
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
     * @var Item
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Item")
     * @ORM\JoinColumn(onDelete="CASCADE", nullable=false, name="ship")
     */
    private $ship;


    /**
     * @var
     *
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\FitData", mappedBy="fit", cascade={"persist"})
     */
    private $fitDatas;

    /**
     * @var SkillSet
     *
     * @ORM\OneToOne(targetEntity="AppBundle\Entity\SkillSet", mappedBy="id")
     * @ORM\JoinColumn(onDelete="SET NULL", nullable=true)
     */
    private $skillsSet;


    /**
     * @var Doctrine
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Doctrine", inversedBy="fits" )
     * @ORM\JoinColumn(nullable=true)
     */
    private $doctrine;


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
     * @return Fit
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
        $this->fitDatas = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add fitData
     *
     * @param \AppBundle\Entity\FitData $fitData
     *
     * @return Fit
     */
    public function addFitData(\AppBundle\Entity\FitData $fitData)
    {
        $this->fitDatas[] = $fitData;
    
        return $this;
    }

    /**
     * Remove fitData
     *
     * @param \AppBundle\Entity\FitData $fitData
     */
    public function removeFitData(\AppBundle\Entity\FitData $fitData)
    {
        $this->fitDatas->removeElement($fitData);
    }

    /**
     * Get fitDatas
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getFitDatas()
    {
        return $this->fitDatas;
    }

    /**
     * Set ship
     *
     * @param \AppBundle\Entity\Item $ship
     *
     * @return Fit
     */
    public function setShip(\AppBundle\Entity\Item $ship)
    {
        $this->ship = $ship;
    
        return $this;
    }

    /**
     * Get ship
     *
     * @return \AppBundle\Entity\Item
     */
    public function getShip()
    {
        return $this->ship;
    }





    /**
     * Set skillsSet
     *
     * @param \AppBundle\Entity\SkillSet $skillsSet
     *
     * @return Fit
     */
    public function setSkillsSet(\AppBundle\Entity\SkillSet $skillsSet = null)
    {
        $this->skillsSet = $skillsSet;
    
        return $this;
    }

    /**
     * Get skillsSet
     *
     * @return \AppBundle\Entity\SkillSet
     */
    public function getSkillsSet()
    {
        return $this->skillsSet;
    }


    /**
     * Set doctrine
     *
     * @param \AppBundle\Entity\Doctrine $doctrine
     *
     * @return Fit
     */
    public function setDoctrine(\AppBundle\Entity\Doctrine $doctrine = null)
    {
        $this->doctrine = $doctrine;
    
        return $this;
    }

    /**
     * Get doctrine
     *
     * @return \AppBundle\Entity\Doctrine
     */
    public function getDoctrine()
    {
        return $this->doctrine;
    }
}
