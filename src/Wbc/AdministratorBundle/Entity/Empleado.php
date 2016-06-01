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
    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $pago_empleado;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->pago_empleado = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add pagoEmpleado
     *
     * @param \Wbc\AdministratorBundle\Entity\PagoEmpleado $pagoEmpleado
     *
     * @return Empleado
     */
    public function addPagoEmpleado(\Wbc\AdministratorBundle\Entity\PagoEmpleado $pagoEmpleado)
    {
        $this->pago_empleado[] = $pagoEmpleado;

        return $this;
    }

    /**
     * Remove pagoEmpleado
     *
     * @param \Wbc\AdministratorBundle\Entity\PagoEmpleado $pagoEmpleado
     */
    public function removePagoEmpleado(\Wbc\AdministratorBundle\Entity\PagoEmpleado $pagoEmpleado)
    {
        $this->pago_empleado->removeElement($pagoEmpleado);
    }

    /**
     * Get pagoEmpleado
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getPagoEmpleado()
    {
        return $this->pago_empleado;
    }
    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $compra;


    /**
     * Add compra
     *
     * @param \Wbc\AdministratorBundle\Entity\Compra $compra
     *
     * @return Empleado
     */
    public function addCompra(\Wbc\AdministratorBundle\Entity\Compra $compra)
    {
        $this->compra[] = $compra;

        return $this;
    }

    /**
     * Remove compra
     *
     * @param \Wbc\AdministratorBundle\Entity\Compra $compra
     */
    public function removeCompra(\Wbc\AdministratorBundle\Entity\Compra $compra)
    {
        $this->compra->removeElement($compra);
    }

    /**
     * Get compra
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getCompra()
    {
        return $this->compra;
    }
}
