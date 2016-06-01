<?php

namespace Wbc\AdministratorBundle\Entity;

/**
 * PagoEmpleado
 */
class PagoEmpleado
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
    private $mes;

    /**
     * @var string
     */
    private $totalBeneficio;

    /**
     * @var string
     */
    private $totalPago;

    /**
     * @var \DateTime
     */
    private $creacion;
    
    
    public function __toString() {
        return $this->empleado->getUser()->getFirstName() . " " . $this->empleado->getUser()->getLastName();
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
     * @return PagoEmpleado
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
     * Set mes
     *
     * @param integer $mes
     *
     * @return PagoEmpleado
     */
    public function setMes($mes)
    {
        $this->mes = $mes;

        return $this;
    }

    /**
     * Get mes
     *
     * @return int
     */
    public function getMes()
    {
        return $this->mes;
    }

    /**
     * Set totalBeneficio
     *
     * @param string $totalBeneficio
     *
     * @return PagoEmpleado
     */
    public function setTotalBeneficio($totalBeneficio)
    {
        $this->totalBeneficio = $totalBeneficio;

        return $this;
    }

    /**
     * Get totalBeneficio
     *
     * @return string
     */
    public function getTotalBeneficio()
    {
        return $this->totalBeneficio;
    }

    /**
     * Set totalPago
     *
     * @param string $totalPago
     *
     * @return PagoEmpleado
     */
    public function setTotalPago($totalPago)
    {
        $this->totalPago = $totalPago;

        return $this;
    }

    /**
     * Get totalPago
     *
     * @return string
     */
    public function getTotalPago()
    {
        return $this->totalPago;
    }

    /**
     * Set creacion
     *
     * @param \DateTime $creacion
     *
     * @return PagoEmpleado
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
     * @var \Wbc\AdministratorBundle\Entity\Empleado
     */
    private $empleado;


    /**
     * Set empleado
     *
     * @param \Wbc\AdministratorBundle\Entity\Empleado $empleado
     *
     * @return PagoEmpleado
     */
    public function setEmpleado(\Wbc\AdministratorBundle\Entity\Empleado $empleado)
    {
        $this->empleado = $empleado;

        return $this;
    }

    /**
     * Get empleado
     *
     * @return \Wbc\AdministratorBundle\Entity\Empleado
     */
    public function getEmpleado()
    {
        return $this->empleado;
    }
}
