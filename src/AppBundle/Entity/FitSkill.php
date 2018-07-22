<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * FitSkill
 *
 * @ORM\Table(name="fit_skill")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\FitSkillRepository")
 */
class FitSkill
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
     * @var Skill
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Skill")
     */
    private $skill;

    /**
     * @var integer
     *
     * @ORM\Column(type="smallint")
     */
    private $skillLevel;


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

