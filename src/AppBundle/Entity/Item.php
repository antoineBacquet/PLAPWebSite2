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
     * @var SkillLevel
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\SkillLevelItem", mappedBy="item")
     * @ORM\JoinColumn(onDelete="CASCADE")
     */
    private $skills;



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
     * Constructor
     */
    public function __construct()
    {
        $this->skills = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add skill
     *
     * @param \AppBundle\Entity\SkillLevelItem $skill
     *
     * @return Item
     */
    public function addSkill(\AppBundle\Entity\SkillLevelItem $skill)
    {
        $this->skills[] = $skill;
    
        return $this;
    }

    /**
     * Remove skill
     *
     * @param \AppBundle\Entity\SkillLevelItem $skill
     */
    public function removeSkill(\AppBundle\Entity\SkillLevelItem $skill)
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
