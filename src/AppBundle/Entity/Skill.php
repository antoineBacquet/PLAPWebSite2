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
    private $name;


    /**
     * @var Skill
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Skill")
     */
    private $skill1;

    /**
     * @var int
     *
     * @ORM\Column(name="skill1Level", type="smallint")
     */
    private $skill1Level;

    /**
     * @var string
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Skill")
     */
    private $skill2;

    /**
     * @var int
     *
     * @ORM\Column(name="skill2Level", type="smallint")
     */
    private $skill2Level;

    /**
     * @var string
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Skill")
     */
    private $skill3;

    /**
     * @var int
     *
     * @ORM\Column(name="skill3Level", type="smallint")
     */
    private $skill3Level;

    /**
     * @var ItemGroup
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\ItemGroup")
     */
    private $group;

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
     * Set skill1
     *
     * @param \AppBundle\Entity\Skill $skill1
     *
     * @return Skill
     */
    public function setSkill1(\AppBundle\Entity\Skill $skill1 = null)
    {
        $this->skill1 = $skill1;
    
        return $this;
    }

    /**
     * Get skill1
     *
     * @return \AppBundle\Entity\Skill
     */
    public function getSkill1()
    {
        return $this->skill1;
    }

    /**
     * Set skill2
     *
     * @param \AppBundle\Entity\Skill $skill2
     *
     * @return Skill
     */
    public function setSkill2(\AppBundle\Entity\Skill $skill2 = null)
    {
        $this->skill2 = $skill2;
    
        return $this;
    }

    /**
     * Get skill2
     *
     * @return \AppBundle\Entity\Skill
     */
    public function getSkill2()
    {
        return $this->skill2;
    }

    /**
     * Set skill3
     *
     * @param \AppBundle\Entity\Skill $skill3
     *
     * @return Skill
     */
    public function setSkill3(\AppBundle\Entity\Skill $skill3 = null)
    {
        $this->skill3 = $skill3;
    
        return $this;
    }

    /**
     * Get skill3
     *
     * @return \AppBundle\Entity\Skill
     */
    public function getSkill3()
    {
        return $this->skill3;
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
     * Set skill1Level
     *
     * @param integer $skill1Level
     *
     * @return Skill
     */
    public function setSkill1Level($skill1Level)
    {
        $this->skill1Level = $skill1Level;
    
        return $this;
    }

    /**
     * Get skill1Level
     *
     * @return integer
     */
    public function getSkill1Level()
    {
        return $this->skill1Level;
    }

    /**
     * Set skill2Level
     *
     * @param integer $skill2Level
     *
     * @return Skill
     */
    public function setSkill2Level($skill2Level)
    {
        $this->skill2Level = $skill2Level;
    
        return $this;
    }

    /**
     * Get skill2Level
     *
     * @return integer
     */
    public function getSkill2Level()
    {
        return $this->skill2Level;
    }

    /**
     * Set skill3Level
     *
     * @param integer $skill3Level
     *
     * @return Skill
     */
    public function setSkill3Level($skill3Level)
    {
        $this->skill3Level = $skill3Level;
    
        return $this;
    }

    /**
     * Get skill3Level
     *
     * @return integer
     */
    public function getSkill3Level()
    {
        return $this->skill3Level;
    }
}
