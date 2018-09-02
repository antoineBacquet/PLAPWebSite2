<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Skill
 *
 * @ORM\Table(name="skill")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\SkillRepository")
 */
class Skill
{


    const ATTRIBUTE_INTELLIGENCE = 'Intelligence';
    const ATTRIBUTE_PERCEPTION = 'Perception';
    const ATTRIBUTE_CHARISMA = 'Charisma';
    const ATTRIBUTE_WILLPOWER = 'Willpower';
    const ATTRIBUTE_MEMORY = 'Memory';
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name = "Unknown skill name";

    /**
     * @var string
     *
     * @ORM\Column(name="primary_attribute", type="string", length=64)
     */
    private $primaryAttribute = Skill::ATTRIBUTE_INTELLIGENCE;

    /**
     * @var string
     *
     * @ORM\Column(name="secondary_attribute", type="string", length=64)
     */
    private $secondaryAttribute = Skill::ATTRIBUTE_INTELLIGENCE;

    /**
     * @var string
     *
     * @ORM\Column(name="time_multiplier", type="smallint")
     */
    private $timeMultiplier = 0;


    /**
     * @var SkillLevel
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\SkillLevel", mappedBy="parent")
     * @ORM\JoinColumn(onDelete="CASCADE")
     */
    private $skills;

    /**
     * @var ItemGroup
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\ItemGroup")
     */
    private $group = 255;

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
     * @return Skill
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
     * Set group
     *
     * @param \AppBundle\Entity\ItemGroup $group
     *
     * @return Skill
     */
    public function setGroup(\AppBundle\Entity\ItemGroup $group = null)
    {
        $this->group = $group;
    
        return $this;
    }

    /**
     * Get group
     *
     * @return \AppBundle\Entity\ItemGroup
     */
    public function getGroup()
    {
        return $this->group;
    }

    /**
     * Set id
     *
     * @param integer $id
     *
     * @return Skill
     */
    public function setId($id)
    {
        $this->id = $id;
    
        return $this;
    }



    /**
     * Set primaryAttribute
     *
     * @param string $primaryAttribute
     *
     * @return Skill
     */
    public function setPrimaryAttribute($primaryAttribute)
    {
        $this->primaryAttribute = $primaryAttribute;
    
        return $this;
    }

    /**
     * Get primaryAttribute
     *
     * @return string
     */
    public function getPrimaryAttribute()
    {
        return $this->primaryAttribute;
    }

    /**
     * Set secondaryAttribute
     *
     * @param string $secondaryAttribute
     *
     * @return Skill
     */
    public function setSecondaryAttribute($secondaryAttribute)
    {
        $this->secondaryAttribute = $secondaryAttribute;
    
        return $this;
    }

    /**
     * Get secondaryAttribute
     *
     * @return string
     */
    public function getSecondaryAttribute()
    {
        return $this->secondaryAttribute;
    }


    /**
     * Set timeMultiplier
     *
     * @param integer $timeMultiplier
     *
     * @return Skill
     */
    public function setTimeMultiplier($timeMultiplier)
    {
        $this->timeMultiplier = $timeMultiplier;
    
        return $this;
    }

    /**
     * Get timeMultiplier
     *
     * @return integer
     */
    public function getTimeMultiplier()
    {
        return $this->timeMultiplier;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->skills = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add skill
     *
     * @param \AppBundle\Entity\SkillLevel $skill
     *
     * @return Skill
     */
    public function addSkill(\AppBundle\Entity\SkillLevel $skill)
    {
        $this->skills[] = $skill;
    
        return $this;
    }

    /**
     * Remove skill
     *
     * @param \AppBundle\Entity\SkillLevel $skill
     */
    public function removeSkill(\AppBundle\Entity\SkillLevel $skill)
    {
        $this->skills->removeElement($skill);
    }

    /**
     * Get skills
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getSkills()
    {
        return $this->skills;
    }
}
