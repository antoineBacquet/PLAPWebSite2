<?php

namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use nullx27\ESI\Models\GetCorporationsCorporationIdOk;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * user
 *
 * @ORM\Table(name="user")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\UserRepository")
 */
class User implements UserInterface, \Serializable
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
     * @var int
     *
     * @ORM\Column(name="char_id", type="integer", unique=true)
     */
    private $charId;

    /**
     * @var int
     *
     * @ORM\Column(name="corp_id", type="integer")
     */
    private $corpId;

    /**
     *
     * @ORM\Column(type="json_array")
     */

    private $roles;

    /**
     * @var GetCorporationsCorporationIdOk
     */
    public $corp;

    /**
     * @ORM\OneToMany(targetEntity="CharApi", mappedBy="user")
     */
    private $apis;

    /**
     * @var int
     *
     * @ORM\OneToOne(targetEntity="AppBundle\Entity\Notification", mappedBy="user"), cascade={"persist"})
     */
    private $notification;


    /**
     * @var int
     *
     * @ORM\Column(name="discord_id", type="bigint", unique=false, nullable=true)
     */
    private $discordId;

    /**
     * @var int
     *
     * @ORM\OneToOne(targetEntity="AppBundle\Entity\Recruitement", mappedBy="user"))
     */
    private $recruitment;

    /**
     * @var int
     *
     * @ORM\OneToOne(targetEntity="CharApi")
     * @ORM\JoinColumn(nullable=true)
     */
    private $mainApi;

    public function __construct()
    {
        $this->apis = new ArrayCollection();
    }

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
     * Set name
     *
     * @param string $name
     *
     * @return user
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
     * Set charId
     *
     * @param integer $charId
     *
     * @return user
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
     * Set corpId
     *
     * @param integer $corpId
     *
     * @return user
     */
    public function setCorpId($corpId)
    {
        $this->corpId = $corpId;

        return $this;
    }

    /**
     * Get corpId
     *
     * @return int
     */
    public function getCorpId()
    {
        return $this->corpId;
    }

    /**
     * Set roles
     *
     * @param array $roles
     * @return User
     */
    public function setRoles($roles)
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * Get roles
     *
     * @return array()
     */
    public function getRoles()
    {

        return $this->roles;
/*
        $rolesTmp = array();

        foreach ($this->roles as $role){
            if($role->getId() === 2)$rolesTmp[] = 'ROLE_MEMBRE';
            else if($role->getId() === 3)$rolesTmp[] = 'ROLE_ADMIN';
        }
*/


        //return $rolesTmp; //TODO
    }

    /**
     * Add role
     *
     * @param string $role
     *
     * @return User
     */
    public function addRole($role)
    {
        $this->roles[] = $role;

        return $this;
    }

    /**
     * Remove role
     *
     * @param string $role
     */
    public function removeRole($role)
    {

        if(array_search($role, $this->roles))
            unset($this->roles[array_search($role, $this->roles)]);

    }



    public function __toString() {
        return $this->id.'';
    }

    /**
     * Add api
     *
     * @param \AppBundle\Entity\CharApi $api
     *
     * @return User
     */
    public function addApi(\AppBundle\Entity\CharApi $api)
    {
        $this->apis[] = $api;

        return $this;
    }

    /**
     * Remove api
     *
     * @param \AppBundle\Entity\CharApi $api
     */
    public function removeApi(\AppBundle\Entity\CharApi $api)
    {
        $this->apis->removeElement($api);
    }

    /**
     * Get apis
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getApis()
    {
        return $this->apis;
    }

    /**
     * Set discordRandomString
     *
     * @param string $discordRandomString
     *
     * @return User
     */
    public function setDiscordRandomString($discordRandomString)
    {
        $this->discordRandomString = $discordRandomString;

        return $this;
    }

    /**
     * Get discordRandomString
     *
     * @return string
     */
    public function getDiscordRandomString()
    {
        return $this->discordRandomString;
    }

    /**
     * Set discordId
     *
     * @param integer $discordId
     *
     * @return User
     */
    public function setDiscordId($discordId)
    {
        $this->discordId = $discordId;

        return $this;
    }

    /**
     * Get discordId
     *
     * @return integer
     */
    public function getDiscordId()
    {
        return $this->discordId;
    }

    /**
     * Set notification
     *
     * @param \AppBundle\Entity\Notification $notification
     *
     * @return User
     */
    public function setNotification(\AppBundle\Entity\Notification $notification = null)
    {
        $this->notification = $notification;
    
        return $this;
    }

    /**
     * Get notification
     *
     * @return \AppBundle\Entity\Notification
     */
    public function getNotification()
    {
        return $this->notification;
    }

    /**
     * Set mainApi
     *
     * @param \AppBundle\Entity\CharApi $mainApi
     *
     * @return User
     */
    public function setMainApi(\AppBundle\Entity\CharApi $mainApi = null)
    {
        $this->mainApi = $mainApi;
    
        return $this;
    }

    /**
     * Get mainApi
     *
     * @return \AppBundle\Entity\CharApi
     */
    public function getMainApi()
    {
        return $this->mainApi;
    }

    public function serialize()
    {
        return serialize(array(
            $this->id,
            $this->name,
        ));
    }

    public function unserialize($serialized)
    {
        list (
            $this->id,
            $this->name,
            ) = unserialize($serialized, ['allowed_classes' => false]);
    }

    public function getPassword()
    {
        return null;
    }

    public function getSalt()
    {
        return null;
    }

    public function getUsername()
    {
        return $this->name;
    }

    public function eraseCredentials()
    {
        // TODO: Implement eraseCredentials() method.
    }



    /**
     * Set recruitment
     *
     * @param \AppBundle\Entity\Recruitement $recruitment
     *
     * @return User
     */
    public function setRecruitment(\AppBundle\Entity\Recruitement $recruitment = null)
    {
        $this->recruitment = $recruitment;
    
        return $this;
    }

    /**
     * Get recruitment
     *
     * @return \AppBundle\Entity\Recruitement
     */
    public function getRecruitment()
    {
        return $this->recruitment;
    }
}
