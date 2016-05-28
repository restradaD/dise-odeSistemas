<?php

namespace Wbc\AdministratorBundle\Entity;

/**
 * Locale
 */
class Locale
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
    private $code;

    /**
     * @var string
     */
    private $flag;


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
     * @return Locale
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
     * Set code
     *
     * @param string $code
     *
     * @return Locale
     */
    public function setCode($code)
    {
        $this->code = $code;

        return $this;
    }

    /**
     * Get code
     *
     * @return string
     */
    public function getCode()
    {
        return $this->code;
    }

    /**
     * Set flag
     *
     * @param string $flag
     *
     * @return Locale
     */
    public function setFlag($flag)
    {
        $this->flag = $flag;

        return $this;
    }

    /**
     * Get flag
     *
     * @return string
     */
    public function getFlag()
    {
        return $this->flag;
    }
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
     * Add user
     *
     * @param \Wbc\AdministratorBundle\Entity\User $user
     *
     * @return Locale
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
    /**
     * @var string
     */
    private $country_code;


    /**
     * Set countryCode
     *
     * @param string $countryCode
     *
     * @return Locale
     */
    public function setCountryCode($countryCode)
    {
        $this->country_code = $countryCode;

        return $this;
    }

    /**
     * Get countryCode
     *
     * @return string
     */
    public function getCountryCode()
    {
        return $this->country_code;
    }
    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $i18n_resource;


    /**
     * Add i18nResource
     *
     * @param \Wbc\AdministratorBundle\Entity\I18NResource $i18nResource
     *
     * @return Locale
     */
    public function addI18nResource(\Wbc\AdministratorBundle\Entity\I18NResource $i18nResource)
    {
        $this->i18n_resource[] = $i18nResource;

        return $this;
    }

    /**
     * Remove i18nResource
     *
     * @param \Wbc\AdministratorBundle\Entity\I18NResource $i18nResource
     */
    public function removeI18nResource(\Wbc\AdministratorBundle\Entity\I18NResource $i18nResource)
    {
        $this->i18n_resource->removeElement($i18nResource);
    }

    /**
     * Get i18nResource
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getI18nResource()
    {
        return $this->i18n_resource;
    }
}
