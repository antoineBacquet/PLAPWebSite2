<?php

namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * ItemGroup
 *
 * @ORM\Table(name="item_market_group")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\ItemGroupRepository")
 */
class ItemMarketGroup
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
     *
     * @ORM\ManyToOne(targetEntity="ItemMarketGroup" ,inversedBy="sons")
     * @ORM\JoinColumn(nullable=true)
     */
    private $parentGroup;

    /**
     *
     * @ORM\OneToMany(targetEntity="ItemMarketGroup" ,mappedBy="parentGroup")
     * @ORM\JoinColumn(nullable=true)
     */
    private $sons;


    /**
     *
     * @ORM\OneToMany(targetEntity="Item" ,mappedBy="itemMarketGroup" )
     * @ORM\JoinColumn(nullable=true)
     */
    private $items;


    public function __construct()
    {
        $this->sons = new ArrayCollection();
        $this->items = new ArrayCollection();
    }


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
     * @return ItemMarketGroup
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
     * Set id
     *
     * @param integer $id
     *
     * @return ItemMarketGroup
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }


    /**
     * Set parentGroup
     *
     * @param \AppBundle\Entity\ItemMarketGroup $parentGroup
     *
     * @return ItemMarketGroup
     */
    public function setParentGroup(\AppBundle\Entity\ItemMarketGroup $parentGroup = null)
    {
        $this->parentGroup = $parentGroup;

        return $this;
    }

    /**
     * Get parentGroup
     *
     * @return \AppBundle\Entity\ItemMarketGroup
     */
    public function getParentGroup()
    {
        return $this->parentGroup;
    }

    /**
     * Add son
     *
     * @param \AppBundle\Entity\ItemMarketGroup $son
     *
     * @return ItemMarketGroup
     */
    public function addSon(\AppBundle\Entity\ItemMarketGroup $son)
    {
        $this->sons[] = $son;

        return $this;
    }

    /**
     * Remove son
     *
     * @param \AppBundle\Entity\ItemMarketGroup $son
     */
    public function removeSon(\AppBundle\Entity\ItemMarketGroup $son)
    {
        $this->sons->removeElement($son);
    }

    /**
     * Get sons
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getSons()
    {
        return $this->sons;
    }

    /**
     * Add item
     *
     * @param \AppBundle\Entity\Item $item
     *
     * @return ItemMarketGroup
     */
    public function addItem(\AppBundle\Entity\Item $item)
    {
        $this->items[] = $item;

        return $this;
    }

    /**
     * Remove item
     *
     * @param \AppBundle\Entity\Item $item
     */
    public function removeItem(\AppBundle\Entity\Item $item)
    {
        $this->items->removeElement($item);
    }

    /**
     * Get items
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getItems()
    {
        return $this->items;
    }
}
