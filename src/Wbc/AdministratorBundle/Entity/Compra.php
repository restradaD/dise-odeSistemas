<?php

namespace Wbc\AdministratorBundle\Entity;

/**
 * Compra
 */
class Compra
{
    /**
     * @var int
     */
    private $id;

    /**
     * @var \DateTime
     */
    private $creacion;


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
     * @return Compra
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
     * @var \Wbc\AdministratorBundle\Entity\Proveedor
     */
    private $proveedor;


    /**
     * Set empleado
     *
     * @param \Wbc\AdministratorBundle\Entity\Empleado $empleado
     *
     * @return Compra
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

    /**
     * Set proveedor
     *
     * @param \Wbc\AdministratorBundle\Entity\Proveedor $proveedor
     *
     * @return Compra
     */
    public function setProveedor(\Wbc\AdministratorBundle\Entity\Proveedor $proveedor)
    {
        $this->proveedor = $proveedor;

        return $this;
    }

    /**
     * Get proveedor
     *
     * @return \Wbc\AdministratorBundle\Entity\Proveedor
     */
    public function getProveedor()
    {
        return $this->proveedor;
    }
}
