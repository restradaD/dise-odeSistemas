<?php

namespace Wbc\AdministratorBundle\Entity;

/**
 * Empleado
 */
class Empleado
{
    /**
     * @var int
     */
    private $id;

    /**
     * @var string
     */
    private $sueldo;

    /**
     * @var int
     */
    private $totalFeriado;

    /**
     * @var \DateTime
     */
    private $fechaCreacion;

    public function __toString() {
        return $this->user->getFirstName() . ' ' . $this->user->getLastName();
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
     * Set sueldo
     *
     * @param string $sueldo
     *
     * @return Empleado
     */
    public function setSueldo($sueldo)
    {
        $this->sueldo = $sueldo;

        return $this;
    }

    /**
     * Get sueldo
     *
     * @return string
     */
    public function getSueldo()
    {
        return $this->sueldo;
    }

    /**
     * Set totalFeriado
     *
     * @param integer $totalFeriado
     *
     * @return Empleado
     */
    public function setTotalFeriado($totalFeriado)
    {
        $this->totalFeriado = $totalFeriado;

        return $this;
    }

    /**
     * Get totalFeriado
     *
     * @return int
     */
    public function getTotalFeriado()
    {
        return $this->totalFeriado;
    }

    /**
     * Set fechaCreacion
     *
     * @param \DateTime $fechaCreacion
     *
     * @return Empleado
     */
    public function setFechaCreacion($fechaCreacion)
    {
        $this->fechaCreacion = $fechaCreacion;

        return $this;
    }

    /**
     * Get fechaCreacion
     *
     * @return \DateTime
     */
    public function getFechaCreacion()
    {
        return $this->fechaCreacion;
    }
    /**
     * @var \Wbc\AdministratorBundle\Entity\User
     */
    private $user;

    /**
     * @var \Wbc\AdministratorBundle\Entity\Beneficio
     */
    private $beneficio;

    /**
     * @var \Wbc\AdministratorBundle\Entity\Empresa
     */
    private $empresa;


    /**
     * Set user
     *
     * @param \Wbc\AdministratorBundle\Entity\User $user
     *
     * @return Empleado
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

    /**
     * Set beneficio
     *
     * @param \Wbc\AdministratorBundle\Entity\Beneficio $beneficio
     *
     * @return Empleado
     */
    public function setBeneficio(\Wbc\AdministratorBundle\Entity\Beneficio $beneficio)
    {
        $this->beneficio = $beneficio;

        return $this;
    }

    /**
     * Get beneficio
     *
     * @return \Wbc\AdministratorBundle\Entity\Beneficio
     */
    public function getBeneficio()
    {
        return $this->beneficio;
    }

    /**
     * Set empresa
     *
     * @param \Wbc\AdministratorBundle\Entity\Empresa $empresa
     *
     * @return Empleado
     */
    public function setEmpresa(\Wbc\AdministratorBundle\Entity\Empresa $empresa)
    {
        $this->empresa = $empresa;

        return $this;
    }

    /**
     * Get empresa
     *
     * @return \Wbc\AdministratorBundle\Entity\Empresa
     */
    public function getEmpresa()
    {
        return $this->empresa;
    }
}
