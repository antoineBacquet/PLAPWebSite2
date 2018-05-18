<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Recruitement
 *
 * @ORM\Table(name="recruitement")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\RecruitementRepository")
 */
class Recruitement
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
     * @ORM\OneToOne(targetEntity="AppBundle\Entity\User")
     * @ORM\JoinColumn(onDelete="CASCADE")
     */
    private $user;

    /**
     * @var int
     *
     * @ORM\Column(name="age", type="integer")
     */
    private $age;

    /**
     * @var bool
     *
     * @ORM\Column(name="mic", type="boolean")
     */
    private $mic;

    /**
     * @var string
     *
     * @ORM\Column(name="eveKnowledge", type="string", length=255)
     */
    private $eveKnowledge;




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
     * Set age
     *
     * @param integer $age
     *
     * @return Recruitement
     */
    public function setAge($age)
    {
        $this->age = $age;
    
        return $this;
    }

    /**
     * Get age
     *
     * @return integer
     */
    public function getAge()
    {
        return $this->age;
    }

    /**
     * Set mic
     *
     * @param boolean $mic
     *
     * @return Recruitement
     */
    public function setMic($mic)
    {
        $this->mic = $mic;
    
        return $this;
    }

    /**
     * Get mic
     *
     * @return boolean
     */
    public function getMic()
    {
        return $this->mic;
    }

    /**
     * Set eveKnowledge
     *
     * @param string $eveKnowledge
     *
     * @return Recruitement
     */
    public function setEveKnowledge($eveKnowledge)
    {
        $this->eveKnowledge = $eveKnowledge;
    
        return $this;
    }

    /**
     * Get eveKnowledge
     *
     * @return string
     */
    public function getEveKnowledge()
    {
        return $this->eveKnowledge;
    }

    /**
     * Set user
     *
     * @param \AppBundle\Entity\User $user
     *
     * @return Recruitement
     */
    public function setUser(\AppBundle\Entity\User $user = null)
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
}
