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
     */
    private $api;
    /**
     * @var
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Item")
     */
    private $ship;


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
}
