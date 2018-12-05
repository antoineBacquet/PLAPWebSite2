<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Fleet
 *
 * @ORM\Table(name="fleet")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\FleetRepository")
 */
class Fleet
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
     * @var \DateTime
     *
     * @ORM\Column(name="datetime", type="datetime")
     */
    private $date;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="description", type="text", length=1024)
     */
    private $description;

    /**
     * @var
     *
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\FleetMember", mappedBy="fleet")
     */

    private $members;




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
     * Set datetime
     *
     * @param \DateTime $datetime
     *
     * @return Fleet
     */
    public function setDatetime($datetime)
    {
        $this->datetime = $datetime;
    
        return $this;
    }

    /**
     * Get datetime
     *
     * @return \DateTime
     */
    public function getDatetime()
    {
        return $this->datetime;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->members = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Set date
     *
     * @param \DateTime $date
     *
     * @return Fleet
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
     * Add member
     *
     * @param \AppBundle\Entity\FleetMember $member
     *
     * @return Fleet
     */
    public function addMember(\AppBundle\Entity\FleetMember $member)
    {
        $this->members[] = $member;
    
        return $this;
    }

    /**
     * Remove member
     *
     * @param \AppBundle\Entity\FleetMember $member
     */
    public function removeMember(\AppBundle\Entity\FleetMember $member)
    {
        $this->members->removeElement($member);
    }

    /**
     * Get members
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getMembers()
    {
        return $this->members;
    }

    /**
     * Set description
     *
     * @param string $description
     *
     * @return Fleet
     */
    public function setDescription($description)
    {
        $this->description = $description;
    
        return $this;
    }

    /**
     * Get description
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }
}
