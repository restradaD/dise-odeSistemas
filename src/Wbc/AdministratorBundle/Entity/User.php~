<?php

namespace Wbc\AdministratorBundle\Entity;

/**
 * User
 */

use FOS\UserBundle\Model\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;

class User extends BaseUser
{
    /**
     * @var integer
     */
    protected $id;
    protected $formal;


    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    public function __construct()
    {
        parent::__construct();
        $this->formal = true;
    }
    /**
     * @var string
     */
    private $first_name;

    /**
     * @var string
     */
    private $last_name;


    /**
     * Set firstName
     *
     * @param string $firstName
     *
     * @return User
     */
    public function setFirstName($firstName)
    {
        $this->first_name = $firstName;

        return $this;
    }

    /**
     * Get firstName
     *
     * @return string
     */
    public function getFirstName()
    {
        return $this->first_name;
    }

    /**
     * Set lastName
     *
     * @param string $lastName
     *
     * @return User
     */
    public function setLastName($lastName)
    {
        $this->last_name = $lastName;

        return $this;
    }

    /**
     * Get lastName
     *
     * @return string
     */
    public function getLastName()
    {
        return $this->last_name;
    }

    public function __toString()
    {
        if($this->first_name && $this->last_name){
            if($this->formal){
                return $this->last_name . ', ' . $this->first_name;
            }else{
                return $this->first_name . ' ' . $this->last_name;
            }
        }else{
            return $this->username;
        }
    }

    public function getInitials(){
        $fullname = self::__toString();
        $fullname = str_replace(',', '', $fullname);

        $names = explode(' ', $fullname);
        $initials = '';

        foreach ($names as $key => $name) {
            $initials .= mb_substr($name, 0, 1, 'utf-8');
        }

        return strtoupper($initials);
    }
    /**
     * @var \Wbc\AdministratorBundle\Entity\Locale
     */
    private $locale;


    /**
     * Set locale
     *
     * @param \Wbc\AdministratorBundle\Entity\Locale $locale
     *
     * @return User
     */
    public function setLocale(\Wbc\AdministratorBundle\Entity\Locale $locale = null)
    {
        $this->locale = $locale;

        return $this;
    }

    /**
     * Get locale
     *
     * @return \Wbc\AdministratorBundle\Entity\Locale
     */
    public function getLocale()
    {
        return $this->locale;
    }

    /**
     * Set greeting
     *
     * @param \Wbc\AdministratorBundle\Entity\Greeting $greeting
     *
     * @return User
     */
    public function setGreeting(\Wbc\AdministratorBundle\Entity\Greeting $greeting = null)
    {
        $this->greeting = $greeting;

        return $this;
    }

    /**
     * Get greeting
     *
     * @return \Wbc\AdministratorBundle\Entity\Greeting
     */
    public function getGreeting()
    {
        return $this->greeting;
    }
    /**
     * @var \Wbc\AdministratorBundle\Entity\Greeting
     */
    private $greeting;

    /**
     * @var \Wbc\AdministratorBundle\Entity\Timezone
     */
    private $timezone;


    /**
     * Set timezone
     *
     * @param \Wbc\AdministratorBundle\Entity\Timezone $timezone
     *
     * @return User
     */
    public function setTimezone(\Wbc\AdministratorBundle\Entity\Timezone $timezone = null)
    {
        $this->timezone = $timezone;

        return $this;
    }

    /**
     * Get timezone
     *
     * @return \Wbc\AdministratorBundle\Entity\Timezone
     */
    public function getTimezone()
    {
        return $this->timezone;
    }
    /**
     * @var string
     */
    private $birthday;


    /**
     * Set birthday
     *
     * @param string $birthday
     *
     * @return User
     */
    public function setBirthday($birthday)
    {
        $this->birthday = $birthday;

        return $this;
    }

    /**
     * Get birthday
     *
     * @return string
     */
    public function getBirthday()
    {
        return $this->birthday;
    }
    /**
     * @var \Wbc\AdministratorBundle\Entity\Role
     */
    private $role;


    /**
     * Set role
     *
     * @param \Wbc\AdministratorBundle\Entity\Role $role
     *
     * @return User
     */
    public function setRole(\Wbc\AdministratorBundle\Entity\Role $role = null)
    {
        $this->role = $role;

        return $this;
    }

    /**
     * Get role
     *
     * @return \Wbc\AdministratorBundle\Entity\Role
     */
    public function getRole()
    {
        return $this->role;
    }
    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $auth_client;


    /**
     * Add authClient
     *
     * @param \Wbc\AuthBundle\Entity\OAuthClient $authClient
     *
     * @return User
     */
    public function addAuthClient(\Wbc\AuthBundle\Entity\OAuthClient $authClient)
    {
        $this->auth_client[] = $authClient;

        return $this;
    }

    /**
     * Remove authClient
     *
     * @param \Wbc\AuthBundle\Entity\OAuthClient $authClient
     */
    public function removeAuthClient(\Wbc\AuthBundle\Entity\OAuthClient $authClient)
    {
        $this->auth_client->removeElement($authClient);
    }

    /**
     * Get authClient
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getAuthClient()
    {
        return $this->auth_client;
    }
}
