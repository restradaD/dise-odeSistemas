<?php

namespace Wbc\AdministratorBundle\Entity;

/**
 * Venta
 */
class Venta
{
    /**
     * @var int
     */
    private $id;

    /**
     * @var \DateTime
     */
    private $creacion;
    
    
    public function __toString() {
        return $this->user->getFirstName() . " " . $this->user->getLastName();
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
     * Set creacion
     *
     * @param \DateTime $creacion
     *
     * @return Venta
     */
    public function setCreacion($creacion)
    {
        $this->creacion = $creacion;

        return $this;
    }

    /**
     * Get creacion
     *
     * @return \DateTime
     */
    public function getCreacion()
    {
        return $this->creacion;
    }
    /**
     * @var \Wbc\AdministratorBundle\Entity\User
     */
    private $user;


    /**
     * Set user
     *
     * @param \Wbc\AdministratorBundle\Entity\User $user
     *
     * @return Venta
     */
    public function setUser(\Wbc\AdministratorBundle\Entity\User $user)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get user
     *
     * @return \Wbc\AdministratorBundle\Entity\User
     */
    public function getUser()
    {
        return $this->user;
    }
}
