<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * SkillSet
 *
 * @ORM\Table(name="skill_set")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\SkillSetRepository")
 */
class SkillSet
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
     * @ORM\Column(name="name", type="string", length=255, nullable=true)
     */
    private $name;

    /**
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\SkillSetData", mappedBy="id")
     * @ORM\JoinColumn(onDelete="CASCADE")
     *
     */
    private $skills;

    /**
     * @ORM\OneToOne(targetEntity="AppBundle\Entity\Fit", mappedBy="skillSet")
     * @ORM\JoinColumn(onDelete="CASCADE")
     *
     */
    private $fit;


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
     * @return SkillSet
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
        $this->skills = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add skill
     *
     * @param \AppBundle\Entity\Skill $skill
     *
     * @return SkillSet
     */
    public function addSkill(\AppBundle\Entity\Skill $skill)
    {
        $this->skills[] = $skill;
    
        return $this;
    }

    /**
     * Remove skill
     *
     * @param \AppBundle\Entity\Skill $skill
     */
    public function removeSkill(\AppBundle\Entity\Skill $skill)
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

    /**
     * Set fit
     *
     * @param \AppBundle\Entity\Fit $fit
     *
     * @return SkillSet
     */
    public function setFit(\AppBundle\Entity\Fit $fit = null)
    {
        $this->fit = $fit;
    
        return $this;
    }

    /**
     * Get fit
     *
     * @return \AppBundle\Entity\Fit
     */
    public function getFit()
    {
        return $this->fit;
    }
}
