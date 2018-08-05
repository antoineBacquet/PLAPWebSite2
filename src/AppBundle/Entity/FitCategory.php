<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * FitCategory
 *
 * @ORM\Table(name="fit_category")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\FitCategoryRepository")
 */
class FitCategory
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
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;


    /**
     * @var SkillSet
     *
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Doctrine", mappedBy="category")
     */
    private $doctrines;


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
     * Set name
     *
     * @param string $name
     *
     * @return FitCategory
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
     * Constructor
     */
    public function __construct()
    {
        $this->fits = new \Doctrine\Common\Collections\ArrayCollection();
    }


    /**
     * Add doctrine
     *
     * @param \AppBundle\Entity\Doctrine $doctrine
     *
     * @return FitCategory
     */
    public function addDoctrine(\AppBundle\Entity\Doctrine $doctrine)
    {
        $this->doctrines[] = $doctrine;
    
        return $this;
    }

    /**
     * Remove doctrine
     *
     * @param \AppBundle\Entity\Doctrine $doctrine
     */
    public function removeDoctrine(\AppBundle\Entity\Doctrine $doctrine)
    {
        $this->doctrines->removeElement($doctrine);
    }

    /**
     * Get doctrines
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getDoctrines()
    {
        return $this->doctrines;
    }


    /**
     * @return string
     */
    public function __toString()
    {
        return $this->name;
    }
}
