<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * job
 *
 * @ORM\Table(name="job")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\JobRepository")
 */
class Job
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="bigint")
     * @ORM\Id
     */
    private $id;

    /**
     * @var int
     *
     * @ORM\Column(name="activityId", type="integer")
     */
    private $activityId;

    /**
     * @var int
     *
     * @ORM\Column(name="blueprintId", type="bigint")
     */
    private $blueprintId;

    /**
     * @var int
     *
     * @ORM\ManyToOne(targetEntity="Item")
     * @ORM\JoinColumn(onDelete="SET NULL", nullable=true)
     */
    private $blueprintTypeId;

    /**
     * @var int
     *
     * @ORM\Column(name="runs", type="integer",options={"default" : 1})
     */
    private $runs = 1;

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
     * @ORM\Column(name="stationId", type="bigint")
     */
    private $stationId;

    /**
     * @var User
     *
     * @ORM\ManyToOne(targetEntity="CharApi")
     * @ORM\JoinColumn(onDelete="cascade")
     */
    private $owner;

    /**
     * @var int
     *
     * @ORM\ManyToOne(targetEntity="Item")
     * @ORM\JoinColumn(onDelete="SET NULL", nullable=true)
     */
    private $productType;

    /**
     * @var int
     *
     * @ORM\Column(name="successfulRun", type="integer", nullable=true)
     */
    private $successfulRun;


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
     * @return Job
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
     * @return Job
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
     * @return Job
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
     * @return Job
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
     * @return Job
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
     * @return Job
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
     * @return Job
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
     * @return Job
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

    /**
     * Set owner
     *
     * @param \AppBundle\Entity\CharApi $owner
     *
     * @return Job
     */
    public function setOwner(\AppBundle\Entity\CharApi $owner = null)
    {
        $this->owner = $owner;
    
        return $this;
    }

    /**
     * Get owner
     *
     * @return \AppBundle\Entity\CharApi
     */
    public function getOwner()
    {
        return $this->owner;
    }

    /**
     * Set id
     *
     * @param integer $id
     *
     * @return Job
     */
    public function setId($id)
    {
        $this->id = $id;
    
        return $this;
    }

    /**
     * Set runs
     *
     * @param integer $runs
     *
     * @return Job
     */
    public function setRuns($runs)
    {
        $this->runs = $runs;
    
        return $this;
    }

    /**
     * Get runs
     *
     * @return integer
     */
    public function getRuns()
    {
        return $this->runs;
    }

    /**
     * Set successfulRun
     *
     * @param integer $successfulRun
     *
     * @return Job
     */
    public function setSuccessfulRun($successfulRun)
    {
        $this->successfulRun = $successfulRun;
    
        return $this;
    }

    /**
     * Get successfulRun
     *
     * @return integer
     */
    public function getSuccessfulRun()
    {
        return $this->successfulRun;
    }

    /**
     * Set productType
     *
     * @param \AppBundle\Entity\Item $productType
     *
     * @return Job
     */
    public function setProductType(\AppBundle\Entity\Item $productType = null)
    {
        $this->productType = $productType;
    
        return $this;
    }

    /**
     * Get productType
     *
     * @return \AppBundle\Entity\Item
     */
    public function getProductType()
    {
        return $this->productType;
    }
}
