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
     * @var array
     *
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\FitSkill", mappedBy="id")
     */
    private $skillsNeeded;


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
     * Add skillsNeeded
     *
     * @param \AppBundle\Entity\Skill $skillsNeeded
     *
     * @return Fit
     */
    public function addSkillsNeeded(\AppBundle\Entity\Skill $skillsNeeded)
    {
        $this->skillsNeeded[] = $skillsNeeded;
    
        return $this;
    }

    /**
     * Remove skillsNeeded
     *
     * @param \AppBundle\Entity\Skill $skillsNeeded
     */
    public function removeSkillsNeeded(\AppBundle\Entity\Skill $skillsNeeded)
    {
        $this->skillsNeeded->removeElement($skillsNeeded);
    }

    /**
     * Get skillsNeeded
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getSkillsNeeded()
    {
        return $this->skillsNeeded;
    }
}
