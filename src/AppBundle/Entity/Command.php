<?php

namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Command
 *
 * @ORM\Table(name="command")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\CommandRepository")
 */
class Command
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
     * @ORM\ManyToOne(targetEntity="User")
     * @ORM\JoinColumn(nullable=false)
     */
    private $issuer;

    /**
     * @var string
     *
     * @ORM\Column(name="state", type="string", length=255)
     */
    private $state;

    /**
     * @var int
     *
     * @ORM\ManyToOne(targetEntity="User")
     *
     */
    private $contractor;

    /**
     * @var int
     *
     * @ORM\OneToMany(targetEntity="CommandItem", mappedBy="command", cascade={"persist"})
     *
     */
    private $items;

    /**
     * @var
     *
     * @ORM\Column(name="date", type="date", nullable=true)
     *
     */
    private $date;

    /**
     * @var string
     *
     * @ORM\Column(name="evepraisal", type="string", length=255, nullable=true)
     *
     */
    private $evepraisal;

    /**
     * @var float
     *
     * @ORM\Column(name="estimated_price", type="bigint", nullable=false)
     *
     */
    private $estimatedPrice;

    /**
     * @var float
     *
     * @ORM\Column(name="suggested_price", type="bigint", nullable=true)
     *
     */
    private $suggestedPrice;


    /**
     * @var boolean
     *
     * @ORM\Column(name="important", type="boolean", nullable=false, options={"default":false})
     *
     */
    private $important;

    public function __construct()
    {

        $this->items = new  ArrayCollection();
    }

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
     * Set issuer
     *
     * @param integer $issuer
     *
     * @return Command
     */
    public function setIssuer($issuer)
    {
        $this->issuer = $issuer;
    
        return $this;
    }

    /**
     * Get issuer
     *
     * @return integer
     */
    public function getIssuer()
    {
        return $this->issuer;
    }

    /**
     * Set state
     *
     * @param string $state
     *
     * @return Command
     */
    public function setState($state)
    {
        $this->state = $state;
    
        return $this;
    }

    /**
     * Get state
     *
     * @return string
     */
    public function getState()
    {
        return $this->state;
    }

    /**
     * Set contractor
     *
     * @param string $contractor
     *
     * @return Command
     */
    public function setContractor($contractor)
    {
        $this->contractor = $contractor;
    
        return $this;
    }

    /**
     * Get contractor
     *
     * @return User
     */
    public function getContractor()
    {
        return $this->contractor;
    }

    /**
     * Set items
     *
     * @param string $items
     *
     * @return Command
     */
    public function setItems($items)
    {
        $this->items = $items;
    
        return $this;
    }

    /**
     * Get items
     *
     * @return array
     */
    public function getItems()
    {
        return $this->items;
    }

    /**
     * Add item
     *
     * @param \AppBundle\Entity\CommandItem $item
     *
     * @return Command
     */
    public function addItem(CommandItem $item)
    {
        $this->items[] = $item;
    
        return $this;
    }

    /**
     * Remove item
     *
     * @param \AppBundle\Entity\CommandItem $item
     */
    public function removeItem(CommandItem $item)
    {
        $this->items->removeElement($item);
    }

    /**
     * Set date
     *
     * @param \DateTime $date
     *
     * @return Command
     */
    public function setDate($date)
    {
        $this->date = $date;
    
        return $this;
    }

    /**
     * Get date
     *
     * @return \DateTime
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * Set evepraisal
     *
     * @param string $evepraisal
     *
     * @return Command
     */
    public function setEvepraisal($evepraisal)
    {
        $this->evepraisal = $evepraisal;
    
        return $this;
    }

    /**
     * Get evepraisal
     *
     * @return string
     */
    public function getEvepraisal()
    {
        return $this->evepraisal;
    }

    /**
     * Set estimatedPrice
     *
     * @param float $estimatedPrice
     *
     * @return Command
     */
    public function setEstimatedPrice($estimatedPrice)
    {
        $this->estimatedPrice = $estimatedPrice;
    
        return $this;
    }

    /**
     * Get estimatedPrice
     *
     * @return float
     */
    public function getEstimatedPrice()
    {
        return $this->estimatedPrice;
    }

    /**
     * Set suggestedPrice
     *
     * @param float $suggestedPrice
     *
     * @return Command
     */
    public function setSuggestedPrice($suggestedPrice)
    {
        $this->suggestedPrice = $suggestedPrice;
    
        return $this;
    }

    /**
     * Get suggestedPrice
     *
     * @return float
     */
    public function getSuggestedPrice()
    {
        return $this->suggestedPrice;
    }

    /**
     * Set important
     *
     * @param boolean $important
     *
     * @return Command
     */
    public function setImportant($important)
    {
        $this->important = $important;
    
        return $this;
    }

    /**
     * Get important
     *
     * @return boolean
     */
    public function getImportant()
    {
        return $this->important;
    }
}
