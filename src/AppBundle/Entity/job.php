<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * job
 *
 * @ORM\Table(name="job")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\jobRepository")
 */
class job
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
     * @ORM\Column(name="ActivityId", type="integer")
     */
    private $activityId;

    /**
     * @var int
     *
     * @ORM\Column(name="BlueprintId", type="integer")
     */
    private $blueprintId;

    /**
     * @var int
     *
     * @ORM\Column(name="blueprintTypeId", type="integer")
     */
    private $blueprintTypeId;

    /**
     * @var string
     *
     * @ORM\Column(name="state", type="string", length=255)
     */
    private $state;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="startDate", type="datetime")
     */
    private $startDate;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="endDate", type="datetime")
     */
    private $endDate;

    /**
     * @var int
     *
     * @ORM\Column(name="duration", type="integer")
     */
    private $duration;

    /**
     * @var int
     *
     * @ORM\Column(name="stationId", type="integer")
     */
    private $stationId;


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
     * Set activityId
     *
     * @param integer $activityId
     *
     * @return job
     */
    public function setActivityId($activityId)
    {
        $this->activityId = $activityId;
    
        return $this;
    }

    /**
     * Get activityId
     *
     * @return integer
     */
    public function getActivityId()
    {
        return $this->activityId;
    }

    /**
     * Set blueprintId
     *
     * @param integer $blueprintId
     *
     * @return job
     */
    public function setBlueprintId($blueprintId)
    {
        $this->blueprintId = $blueprintId;
    
        return $this;
    }

    /**
     * Get blueprintId
     *
     * @return integer
     */
    public function getBlueprintId()
    {
        return $this->blueprintId;
    }

    /**
     * Set blueprintTypeId
     *
     * @param integer $blueprintTypeId
     *
     * @return job
     */
    public function setBlueprintTypeId($blueprintTypeId)
    {
        $this->blueprintTypeId = $blueprintTypeId;
    
        return $this;
    }

    /**
     * Get blueprintTypeId
     *
     * @return integer
     */
    public function getBlueprintTypeId()
    {
        return $this->blueprintTypeId;
    }

    /**
     * Set state
     *
     * @param string $state
     *
     * @return job
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
     * Set startDate
     *
     * @param \DateTime $startDate
     *
     * @return job
     */
    public function setStartDate($startDate)
    {
        $this->startDate = $startDate;
    
        return $this;
    }

    /**
     * Get startDate
     *
     * @return \DateTime
     */
    public function getStartDate()
    {
        return $this->startDate;
    }

    /**
     * Set endDate
     *
     * @param \DateTime $endDate
     *
     * @return job
     */
    public function setEndDate($endDate)
    {
        $this->endDate = $endDate;
    
        return $this;
    }

    /**
     * Get endDate
     *
     * @return \DateTime
     */
    public function getEndDate()
    {
        return $this->endDate;
    }

    /**
     * Set duration
     *
     * @param integer $duration
     *
     * @return job
     */
    public function setDuration($duration)
    {
        $this->duration = $duration;
    
        return $this;
    }

    /**
     * Get duration
     *
     * @return integer
     */
    public function getDuration()
    {
        return $this->duration;
    }

    /**
     * Set stationId
     *
     * @param integer $stationId
     *
     * @return job
     */
    public function setStationId($stationId)
    {
        $this->stationId = $stationId;
    
        return $this;
    }

    /**
     * Get stationId
     *
     * @return integer
     */
    public function getStationId()
    {
        return $this->stationId;
    }
}

