<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Route
 *
 * @ORM\Table(name="route")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\RouteRepository")
 */
class Route
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
     * @var System
     *
     * @ORM\ManyToOne(targetEntity="System")
     * @ORM\JoinColumn(onDelete="CASCADE", nullable=false)
     */
    private $start;

    /**
     * @var System
     *
     * @ORM\ManyToOne(targetEntity="System")
     * @ORM\JoinColumn(onDelete="CASCADE", nullable=false)
     */
    private $end;

    /**
     * @var int
     *
     * @ORM\Column(name="maxSize", type="bigint")
     */
    private $maxSize;

    /**
     * @var int
     *
     * @ORM\Column(name="maxColat", type="bigint")
     */
    private $maxColat;

    /**
     * @var int
     *
     * @ORM\Column(name="price", type="bigint")
     */
    private $price;

    /**
     * @var int
     *
     * @ORM\Column(name="danger1b", type="bigint")
     */
    private $danger1b;

    /**
     * @var int
     *
     * @ORM\Column(name="danger5b", type="bigint")
     */
    private $danger5b;

    /**
     * @var int
     *
     * @ORM\Column(name="danger10b", type="bigint")
     */
    private $danger10b;

    /**
     * @var int
     *
     * @ORM\Column(name="dangerMax", type="bigint")
     */
    private $dangerMax;


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
     * Set start
     *
     * @param System $start
     *
     * @return Route
     */
    public function setStart($start)
    {
        $this->start = $start;
    
        return $this;
    }

    /**
     * Get start
     *
     * @return System
     */
    public function getStart()
    {
        return $this->start;
    }

    /**
     * Set end
     *
     * @param System $end
     *
     * @return Route
     */
    public function setEnd($end)
    {
        $this->end = $end;
    
        return $this;
    }

    /**
     * Get end
     *
     * @return System
     */
    public function getEnd()
    {
        return $this->end;
    }

    /**
     * Set maxSize
     *
     * @param integer $maxSize
     *
     * @return Route
     */
    public function setMaxSize($maxSize)
    {
        $this->maxSize = $maxSize;
    
        return $this;
    }

    /**
     * Get maxSize
     *
     * @return integer
     */
    public function getMaxSize()
    {
        return $this->maxSize;
    }

    /**
     * Set maxColat
     *
     * @param integer $maxColat
     *
     * @return Route
     */
    public function setMaxColat($maxColat)
    {
        $this->maxColat = $maxColat;
    
        return $this;
    }

    /**
     * Get maxColat
     *
     * @return integer
     */
    public function getMaxColat()
    {
        return $this->maxColat;
    }

    /**
     * Set price
     *
     * @param integer $price
     *
     * @return Route
     */
    public function setPrice($price)
    {
        $this->price = $price;
    
        return $this;
    }

    /**
     * Get price
     *
     * @return integer
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * Set danger1b
     *
     * @param integer $danger1b
     *
     * @return Route
     */
    public function setDanger1b($danger1b)
    {
        $this->danger1b = $danger1b;
    
        return $this;
    }

    /**
     * Get danger1b
     *
     * @return integer
     */
    public function getDanger1b()
    {
        return $this->danger1b;
    }

    /**
     * Set danger5b
     *
     * @param integer $danger5b
     *
     * @return Route
     */
    public function setDanger5b($danger5b)
    {
        $this->danger5b = $danger5b;
    
        return $this;
    }

    /**
     * Get danger5b
     *
     * @return integer
     */
    public function getDanger5b()
    {
        return $this->danger5b;
    }

    /**
     * Set danger10b
     *
     * @param integer $danger10b
     *
     * @return Route
     */
    public function setDanger10b($danger10b)
    {
        $this->danger10b = $danger10b;
    
        return $this;
    }

    /**
     * Get danger10b
     *
     * @return integer
     */
    public function getDanger10b()
    {
        return $this->danger10b;
    }

    /**
     * Set dangerMax
     *
     * @param integer $dangerMax
     *
     * @return Route
     */
    public function setDangerMax($dangerMax)
    {
        $this->dangerMax = $dangerMax;
    
        return $this;
    }

    /**
     * Get dangerMax
     *
     * @return integer
     */
    public function getDangerMax()
    {
        return $this->dangerMax;
    }
}
