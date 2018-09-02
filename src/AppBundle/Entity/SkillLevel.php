<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * SkillLevel
 *
 * @ORM\Table(name="skill_level")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\SkillLevelRepository")
 */
class SkillLevel
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
     * @var Skill
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Skill")
     * @ORM\JoinColumn(nullable=false, onDelete="CASCADE")
     */
    private $skill;

    /**
     * @var int
     *
     * @ORM\Column(name="level", type="smallint")
     */
    private $level;

    /**
     * @var Skill
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Skill", inversedBy="skills")
     * @ORM\JoinColumn(nullable=false, onDelete="CASCADE")
     */
    private $parent;



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
     * @return SkillLevel
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
     * Set skill
     *
     * @param $skill
     *
     * @return SkillLevel
     */
    public function setSkill( $skill)
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

    /**
     * Set parent
     *
     * @param \AppBundle\Entity\Skill $parent
     *
     * @return SkillLevel
     */
    public function setParent(\AppBundle\Entity\Skill $parent)
    {
        $this->parent = $parent;
    
        return $this;
    }

    /**
     * Get parent
     *
     * @return \AppBundle\Entity\Skill
     */
    public function getParent()
    {
        return $this->parent;
    }
}
