<?php

namespace Wbc\AdministratorBundle\Entity;

/**
 * Timezone
 */
class Timezone
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var string
     */
    private $name;

    /**
     * @var string
     */
    private $utc_offset;

    /**
     * @var string
     */
    private $php_name;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $user;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->user = new \Doctrine\Common\Collections\ArrayCollection();
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

    /**
     * Set name
     *
     * @param string $name
     *
     * @return Timezone
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
     * Set utcOffset
     *
     * @param string $utcOffset
     *
     * @return Timezone
     */
    public function setUtcOffset($utcOffset)
    {
        $this->utc_offset = $utcOffset;

        return $this;
    }

    /**
     * Get utcOffset
     *
     * @return string
     */
    public function getUtcOffset()
    {
        return $this->utc_offset;
    }

    /**
     * Set phpName
     *
     * @param string $phpName
     *
     * @return Timezone
     */
    public function setPhpName($phpName)
    {
        $this->php_name = $phpName;

        return $this;
    }

    /**
     * Get phpName
     *
     * @return string
     */
    public function getPhpName()
    {
        return $this->php_name;
    }

    /**
     * Add user
     *
     * @param \Wbc\AdministratorBundle\Entity\User $user
     *
     * @return Timezone
     */
    public function addUser(\Wbc\AdministratorBundle\Entity\User $user)
    {
        $this->user[] = $user;

        return $this;
    }

    /**
     * Remove user
     *
     * @param \Wbc\AdministratorBundle\Entity\User $user
     */
    public function removeUser(\Wbc\AdministratorBundle\Entity\User $user)
    {
        $this->user->removeElement($user);
    }

    /**
     * Get user
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getUser()
    {
        return $this->user;
    }

    public function __toString()
    {
        return $this->name;
    }
}
