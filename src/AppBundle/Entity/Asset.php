<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Asset
 *
 * @ORM\Table(name="asset")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\AssetRepository")
 */
class Asset
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="bigint")
     * @ORM\Id
     */
    private $id;
    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255 , nullable=true)
     */
    private $name;


    /**
     * @var User
     *
     * @ORM\ManyToOne(targetEntity="CharApi")
     * @ORM\JoinColumn(onDelete="cascade")
     */
    private $owner;

    /**
     * @var Item
     *
     * @ORM\ManyToOne(targetEntity="Item")
     * @ORM\JoinColumn(onDelete="CASCADE")
     */
    private $item;

    /**
     * @var int
     *
     * @ORM\Column(name="quantity", type="integer")
     */
    private $quantity;

    /**
     * @var int
     *
     * @ORM\Column(name="location", type="bigint")
     */
    private $location;

    /**
     * @var string
     *
     * @ORM\Column(name="locationType", type="string", length=255, nullable=true)
     */
    private $locationType;

    /**
     * @var string
     *
     * @ORM\Column(name="locationFlag", type="string", length=255, nullable=true)
     */
    private $locationFlag;

    /**
     * @var bool
     *
     * @ORM\Column(name="isSingleton", type="boolean", nullable=true)
     */
    private $isSingleton;

    /**
     * @var
     *
     * @ORM\ManyToOne(targetEntity="asset", inversedBy="childs")
     * @ORM\JoinColumn(nullable=true, onDelete="SET NULL")
     *
     */
    private $parent;

    /**
     * @var
     *
     * @ORM\OneToMany(targetEntity="asset", mappedBy="parent")
     */
    private $childs;






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
     * Set owner
     *
     * @param CharApi $owner
     *
     * @return Asset
     */
    public function setOwner($owner)
    {
        $this->owner = $owner;
    
        return $this;
    }

    /**
     * Get owner
     *
     * @return CharApi
     */
    public function getOwner()
    {
        return $this->owner;
    }

    /**
     * Set item
     *
     * @param Item $item
     *
     * @return Asset
     */
    public function setItem($item)
    {
        $this->item = $item;
    
        return $this;
    }

    /**
     * Get item
     *
     * @return Item
     */
    public function getItem()
    {
        return $this->item;
    }

    /**
     * Set quantity
     *
     * @param integer $quantity
     *
     * @return Asset
     */
    public function setQuantity($quantity)
    {
        $this->quantity = $quantity;
    
        return $this;
    }

    /**
     * Get quantity
     *
     * @return integer
     */
    public function getQuantity()
    {
        return $this->quantity;
    }

    /**
     * Set location
     *
     * @param integer $location
     *
     * @return Asset
     */
    public function setLocation($location)
    {
        $this->location = $location;
    
        return $this;
    }

    /**
     * Get location
     *
     * @return integer
     */
    public function getLocation()
    {
        return $this->location;
    }

    /**
     * Set locationType
     *
     * @param string $locationType
     *
     * @return Asset
     */
    public function setLocationType($locationType)
    {
        $this->locationType = $locationType;
    
        return $this;
    }

    /**
     * Get locationType
     *
     * @return string
     */
    public function getLocationType()
    {
        return $this->locationType;
    }

    /**
     * Set locationFlag
     *
     * @param string $locationFlag
     *
     * @return Asset
     */
    public function setLocationFlag($locationFlag)
    {
        $this->locationFlag = $locationFlag;
    
        return $this;
    }

    /**
     * Get locationFlag
     *
     * @return string
     */
    public function getLocationFlag()
    {
        return $this->locationFlag;
    }

    /**
     * Set isSingleton
     *
     * @param boolean $isSingleton
     *
     * @return Asset
     */
    public function setIsSingleton($isSingleton)
    {
        $this->isSingleton = $isSingleton;
    
        return $this;
    }

    /**
     * Get isSingleton
     *
     * @return boolean
     */
    public function getIsSingleton()
    {
        return $this->isSingleton;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->childs = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Set parent
     *
     * @param \AppBundle\Entity\asset $parent
     *
     * @return Asset
     */
    public function setParent(\AppBundle\Entity\asset $parent = null)
    {
        $this->parent = $parent;
    
        return $this;
    }

    /**
     * Get parent
     *
     * @return \AppBundle\Entity\asset
     */
    public function getParent()
    {
        return $this->parent;
    }

    /**
     * Add child
     *
     * @param \AppBundle\Entity\asset $child
     *
     * @return Asset
     */
    public function addChild(\AppBundle\Entity\asset $child)
    {
        $this->childs[] = $child;
    
        return $this;
    }

    /**
     * Remove child
     *
     * @param \AppBundle\Entity\asset $child
     */
    public function removeChild(\AppBundle\Entity\asset $child)
    {
        $this->childs->removeElement($child);
    }

    /**
     * Get childs
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getChilds()
    {
        return $this->childs;
    }

    /**
     * Set id
     *
     * @param integer $id
     *
     * @return Asset
     */
    public function setId($id)
    {
        $this->id = $id;
    
        return $this;
    }

    /**
     * Set name
     *
     * @param string $name
     *
     * @return Asset
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
}
