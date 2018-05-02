<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Notification
 *
 * @ORM\Table(name="notification")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\NotificationRepository")
 */
class Notification
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
     * @ORM\OneToOne(targetEntity="AppBundle\Entity\User", inversedBy="notification")
     */
    private $user;

    /**
     * @var boolean
     *
     * @ORM\Column(name="emailNotification", type="boolean")
     *
     */
    private $emailNotification = false;



    /**
     * Set emailNotification
     *
     * @param boolean $emailNotification
     *
     * @return Notification
     */
    public function setEmailNotification($emailNotification)
    {
        $this->emailNotification = $emailNotification;
    
        return $this;
    }

    /**
     * Get emailNotification
     *
     * @return boolean
     */
    public function getEmailNotification()
    {
        return $this->emailNotification;
    }

    /**
     * Set user
     *
     * @param \AppBundle\Entity\User $user
     *
     * @return Notification
     */
    public function setUser(\AppBundle\Entity\User $user)
    {
        $this->user = $user;
    
        return $this;
    }

    /**
     * Get user
     *
     * @return \AppBundle\Entity\User
     */
    public function getUser()
    {
        return $this->user;
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
}
