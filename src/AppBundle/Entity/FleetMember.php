<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * FleetMember
 *
 * @ORM\Table(name="fleet_member")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\FleetMemberRepository")
 */
class FleetMember
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
     * @var
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\CharApi")
     * @ORM\JoinColumn(onDelete="SET NULL")
     */
    private $api;

    /**
     * @var int
     *
     * @ORM\Column(name="char_id", type="bigint")
     */
    private $charId;


    /**
     * @var string
     *
     * @ORM\Column(name="char_name", type="text", length=255, nullable=true)
     */
    private $charName;

    /**
     * @var
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Item")
     */
    private $ship;

    /**
     * @var
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\System")
     */
    private $system;


    /**
     * @var
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Fleet", inversedBy="members")
     */
    private $fleet;



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
     * Set api
     *
     * @param \AppBundle\Entity\CharApi $api
     *
     * @return FleetMember
     */
    public function setApi(\AppBundle\Entity\CharApi $api = null)
    {
        $this->api = $api;
    
        return $this;
    }

    /**
     * Get api
     *
     * @return \AppBundle\Entity\CharApi
     */
    public function getApi()
    {
        return $this->api;
    }

    /**
     * Set ship
     *
     * @param \AppBundle\Entity\Item $ship
     *
     * @return FleetMember
     */
    public function setShip(\AppBundle\Entity\Item $ship = null)
    {
        $this->ship = $ship;
    
        return $this;
    }

    /**
     * Get ship
     *
     * @return \AppBundle\Entity\Item
     */
    public function getShip()
    {
        return $this->ship;
    }

    /**
     * Set fleet
     *
     * @param \AppBundle\Entity\Fleet $fleet
     *
     * @return FleetMember
     */
    public function setFleet(\AppBundle\Entity\Fleet $fleet = null)
    {
        $this->fleet = $fleet;
    
        return $this;
    }

    /**
     * Get fleet
     *
     * @return \AppBundle\Entity\Fleet
     */
    public function getFleet()
    {
        return $this->fleet;
    }

    /**
     * Set charId
     *
     * @param integer $charId
     *
     * @return FleetMember
     */
    public function setCharId($charId)
    {
        $this->charId = $charId;
    
        return $this;
    }

    /**
     * Get charId
     *
     * @return integer
     */
    public function getCharId()
    {
        return $this->charId;
    }

    /**
     * Set charName
     *
     * @param string $charName
     *
     * @return FleetMember
     */
    public function setCharName($charName)
    {
        $this->charName = $charName;
    
        return $this;
    }

    /**
     * Get charName
     *
     * @return string
     */
    public function getCharName()
    {
        return $this->charName;
    }

    /**
     * Set system
     *
     * @param \AppBundle\Entity\System $system
     *
     * @return FleetMember
     */
    public function setSystem(\AppBundle\Entity\System $system = null)
    {
        $this->system = $system;
    
        return $this;
    }

    /**
     * Get system
     *
     * @return \AppBundle\Entity\System
     */
    public function getSystem()
    {
        return $this->system;
    }
}
