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
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var User
     *
     * @ORM\ManyToOne(targetEntity="User")
     */
    private $owner;

    /**
     * @var Item
     *
     * @ORM\ManyToOne(targetEntity="Item")
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
     * @ORM\Column(name="location", type="integer")
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
     * @param integer $owner
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
     * @return integer
     */
    public function getOwner()
    {
        return $this->owner;
    }

    /**
     * Set item
     *
     * @param integer $item
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
     * @return integer
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
}
