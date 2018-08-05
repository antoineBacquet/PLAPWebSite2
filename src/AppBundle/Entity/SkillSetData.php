<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * SkillSetData
 *
 * @ORM\Table(name="skill_set_data")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\SkillSetDataRepository")
 */
class SkillSetData
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
     * @var int
     *
     * @ORM\Column(name="level", type="smallint")
     */
    private $level;

    /**
     * @var Skill
     * @ORM\OneToOne(targetEntity="AppBundle\Entity\Skill", mappedBy="id")
     * @ORM\JoinColumn(onDelete="CASCADE")
     *
     */
    private $skill;


    /**
     * @var SkillSet
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\SkillSet", inversedBy="skills")
     * @ORM\JoinColumn(onDelete="CASCADE")
     */
    private $skillSet;


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
     * Set level
     *
     * @param integer $level
     *
     * @return SkillSetData
     */
    public function setLevel($level)
    {
        $this->level = $level;
    
        return $this;
    }

    /**
     * Get level
     *
     * @return integer
     */
    public function getLevel()
    {
        return $this->level;
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
     * @return SkillSetData
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
     * Set skillSet
     *
     * @param \AppBundle\Entity\SkillSet $skillSet
     *
     * @return SkillSetData
     */
    public function setSkillSet(\AppBundle\Entity\SkillSet $skillSet = null)
    {
        $this->skillSet = $skillSet;
    
        return $this;
    }

    /**
     * Get skillSet
     *
     * @return \AppBundle\Entity\SkillSet
     */
    public function getSkillSet()
    {
        return $this->skillSet;
    }

    /**
     * Set skills
     *
     * @param \AppBundle\Entity\Skill $skills
     *
     * @return SkillSetData
     */
    public function setSkills(\AppBundle\Entity\Skill $skills = null)
    {
        $this->skills = $skills;
    
        return $this;
    }

    /**
     * Set skill
     *
     * @param \AppBundle\Entity\Skill $skill
     *
     * @return SkillSetData
     */
    public function setSkill(\AppBundle\Entity\Skill $skill = null)
    {
        $this->skill = $skill;
    
        return $this;
    }

    /**
     * Get skill
     *
     * @return \AppBundle\Entity\Skill
     */
    public function getSkill()
    {
        return $this->skill;
    }
}
