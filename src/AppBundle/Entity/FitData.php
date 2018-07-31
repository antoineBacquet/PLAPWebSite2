<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * FitData
 *
 * @ORM\Table(name="fit_data")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\FitDataRepository")
 */
class FitData
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
     * @var integer
     *
     * @ORM\Column(type="integer", name="slot", nullable=false)
     */
    private $slot;

    /**
     * @var integer
     *
     * @ORM\Column(type="integer", name="quantity", nullable=false)
     */
    private $quantity;


    /**
     * @var Item
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Item")
     * @ORM\JoinColumn(onDelete="CASCADE", nullable=false)
     */
    private $item;

    /**
     * @var Fit
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Fit", inversedBy="fitDatas", cascade={"persist"})
     * @ORM\JoinColumn(onDelete="CASCADE")
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
     * Constructor
     */
    public function __construct()
    {
        $this->item = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Set slot
     *
     * @param integer $slot
     *
     * @return FitData
     */
    public function setSlot($slot)
    {
        $this->slot = $slot;
    
        return $this;
    }

    /**
     * Get slot
     *
     * @return integer
     */
    public function getSlot()
    {
        return $this->slot;
    }

    /**
     * Set quantity
     *
     * @param integer $quantity
     *
     * @return FitData
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
     * Add item
     *
     * @param \AppBundle\Entity\Item $item
     *
     * @return FitData
     */
    public function addItem(\AppBundle\Entity\Item $item)
    {
        $this->item[] = $item;
    
        return $this;
    }

    /**
     * Remove item
     *
     * @param \AppBundle\Entity\Item $item
     */
    public function removeItem(\AppBundle\Entity\Item $item)
    {
        $this->item->removeElement($item);
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
     * Set fit
     *
     * @param \AppBundle\Entity\Fit $fit
     *
     * @return FitData
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

    /**
     * Set item
     *
     * @param \AppBundle\Entity\Item $item
     *
     * @return FitData
     */
    public function setItem(\AppBundle\Entity\Item $item)
    {
        $this->item = $item;
    
        return $this;
    }
}
