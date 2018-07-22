<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Item
 *
 * @ORM\Table(name="item")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\ItemRepository")
 */
class Item
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
     * @var float
     *
     * @ORM\Column(name="volume", type="float")
     */
    private $volume;
    /**
     *
     * @ORM\ManyToOne(targetEntity="ItemGroup" ,inversedBy="items")
     * @ORM\JoinColumn(nullable=true, onDelete="SET NULL")
     */
    private $itemGroup;

    /**
     *
     * @ORM\ManyToOne(targetEntity="ItemMarketGroup" ,inversedBy="items")
     * @ORM\JoinColumn(nullable=true, onDelete="SET NULL")
     */
    private $itemMarketGroup;

    /**
     * @var int
     *
     * @ORM\Column(name="iconId", type="integer", nullable=true)
     */
    private $iconId;

    /**
     * @var Skill
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Skill")
     */
    private $skill1;

    /**
     * @var int
     *
     * @ORM\Column(name="skill1Level", type="smallint", nullable=true)
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
     * @ORM\Column(name="skill2Level", type="smallint", nullable=true)
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
     * @ORM\Column(name="skill3Level", type="smallint", nullable=true)
     */
    private $skill3Level;


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
     * Set name
     *
     * @param string $name
     *
     * @return Item
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
     * Set volume
     *
     * @param float $volume
     *
     * @return Item
     */
    public function setVolume($volume)
    {
        $this->volume = $volume;

        return $this;
    }

    /**
     * Get volume
     *
     * @return float
     */
    public function getVolume()
    {
        return $this->volume;
    }

    /**
     * Set iconId
     *
     * @param integer $iconId
     *
     * @return Item
     */
    public function setIconId($iconId)
    {
        $this->iconId = $iconId;

        return $this;
    }

    /**
     * Get iconId
     *
     * @return int
     */
    public function getIconId()
    {
        return $this->iconId;
    }

    /**
     * Set id
     *
     * @param integer $id
     *
     * @return Item
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Set itemGroup
     *
     * @param \AppBundle\Entity\ItemMarketGroup $itemMarketGroup
     *
     * @return Item
     */
    public function setItemMarketGroup(\AppBundle\Entity\ItemMarketGroup $itemMarketGroup = null)
    {
        $this->itemMarketGroup = $itemMarketGroup;

        return $this;
    }

    /**
     * Get itemGroup
     *
     * @return \AppBundle\Entity\ItemMarketGroup
     */
    public function getItemMarketGroup()
    {
        return $this->itemMarketGroup;
    }

    /**
     * Set itemGroup
     *
     * @param \AppBundle\Entity\ItemGroup $itemGroup
     *
     * @return Item
     */
    public function setItemGroup(\AppBundle\Entity\ItemGroup $itemGroup = null)
    {
        $this->itemGroup = $itemGroup;
    
        return $this;
    }

    /**
     * Get itemGroup
     *
     * @return \AppBundle\Entity\ItemGroup
     */
    public function getItemGroup()
    {
        return $this->itemGroup;
    }

    /**
     * Set skill1Level
     *
     * @param integer $skill1Level
     *
     * @return Item
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
     * @return Item
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
     * @return Item
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

    /**
     * Set skill1
     *
     * @param \AppBundle\Entity\Skill $skill1
     *
     * @return Item
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
     * @return Item
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
     * @return Item
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
}
