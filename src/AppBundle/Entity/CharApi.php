<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints\DateTime;

/**
 * CharApi
 *
 * @ORM\Table(name="char_api")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\CharApiRepository")
 */
class CharApi
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
     * @ORM\Column(name="charId", type="integer")
     */
    private $charId;

    /**
     * @var string
     *
     * @ORM\Column(name="token", type="string", length=1024)
     */
    private $token;

    /**
     * @var string
     *
     * @ORM\Column(name="refreshToken", type="string", length=1024)
     */
    private $refreshToken;

    /**
     * @var string
     *
     * @ORM\Column(name="charName", type="string", length=255)
     */
    private $charName;

    /**
     * @var string
     *
     * @ORM\Column(name="expireOn", type="datetime")
     */
    private $expireOn;

    /**
     * @var int
     *
     * @ORM\Column(name="lastEmail", type="integer",nullable=false,  options={"default":0})
     */
    private $lastEmail;
    /**
     * @var int
     *
     * @ORM\ManyToOne(targetEntity="User", inversedBy="apis")
     * @ORM\JoinColumn(nullable=false, onDelete="CASCADE")
     */
    private $user;

    /**
     * @var \DateTime
     *
     * @ORM\Column(type="datetime", nullable=true, options={"default":null})
     */
    private $lastAssetUpdate;

    /**
     * @var boolean
     *
     */
    public $isValid = false;

    /**
     * @var string
     *
     */
    public $portrait = null;


    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set charId
     *
     * @param integer $charId
     *
     * @return CharApi
     */
    public function setCharId($charId)
    {
        $this->charId = $charId;

        return $this;
    }

    /**
     * Get charId
     *
     * @return int
     */
    public function getCharId()
    {
        return $this->charId;
    }

    /**
     * Set token
     *
     * @param string $token
     *
     * @return CharApi
     */
    public function setToken($token)
    {
        $this->token = $token;

        return $this;
    }

    /**
     * Get token
     *
     * @return string
     */
    public function getToken()
    {
        return $this->token;
    }

    /**
     * Set refreshToken
     *
     * @param string $refreshToken
     *
     * @return CharApi
     */
    public function setRefreshToken($refreshToken)
    {
        $this->refreshToken = $refreshToken;

        return $this;
    }

    /**
     * Get refreshToken
     *
     * @return string
     */
    public function getRefreshToken()
    {
        return $this->refreshToken;
    }

    /**
     * Set charName
     *
     * @param string $charName
     *
     * @return CharApi
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
     * Set userId
     *
     * @param integer $userId
     *
     * @return CharApi
     */
    public function setUser($user)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get userId
     *
     * @return User
     */
    public function getUser()
    {
        return $this->user;
    }
    /**
     * Set lastEmail
     *
     * @param integer $lastEmail
     *
     * @return CharApi
     */
    public function setLastEmail($lastEmail)
    {
        $this->lastEmail = $lastEmail;
    
        return $this;
    }

    /**
     * Get lastEmail
     *
     * @return integer
     */
    public function getLastEmail()
    {
        return $this->lastEmail;
    }


    /**
     * Set createDate
     *
     * @param \DateTime $createDate
     *
     * @return CharApi
     */
    public function setCreateDate($createDate)
    {
        $this->createDate = $createDate;
    
        return $this;
    }

    /**
     * Get createDate
     *
     * @return \DateTime
     */
    public function getCreateDate()
    {
        return $this->createDate;
    }

    /**
     * Set expireIn
     *
     * @param integer $expireIn
     *
     * @return CharApi
     */
    public function setExpireIn($expireIn)
    {
        $this->expireIn = $expireIn;
    
        return $this;
    }

    /**
     * Get expireIn
     *
     * @return integer
     */
    public function getExpireIn()
    {
        return $this->expireIn;
    }

    /**
     * Set expireOn
     *
     * @param \DateTime $expireOn
     *
     * @return CharApi
     */
    public function setExpireOn($expireOn)
    {
        $this->expireOn = $expireOn;
    
        return $this;
    }

    /**
     * Get expireOn
     *
     * @return \DateTime
     */
    public function getExpireOn()
    {
        return $this->expireOn;
    }

    /**
     * Set lastAssetUpdate
     *
     * @param \DateTime $lastAssetUpdate
     *
     * @return CharApi
     */
    public function setLastAssetUpdate($lastAssetUpdate)
    {
        $this->lastAssetUpdate = $lastAssetUpdate;
    
        return $this;
    }

    /**
     * Get lastAssetUpdate
     *
     * @return \DateTime
     */
    public function getLastAssetUpdate()
    {
        return $this->lastAssetUpdate;
    }

    public function __toString()
    {
        return $this->charName;
    }


}
