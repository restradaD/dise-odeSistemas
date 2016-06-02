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
    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $factura;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->factura = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add factura
     *
     * @param \Wbc\AdministratorBundle\Entity\Factura $factura
     *
     * @return Compra
     */
    public function addFactura(\Wbc\AdministratorBundle\Entity\Factura $factura)
    {
        $this->factura[] = $factura;

        return $this;
    }

    /**
     * Remove factura
     *
     * @param \Wbc\AdministratorBundle\Entity\Factura $factura
     */
    public function removeFactura(\Wbc\AdministratorBundle\Entity\Factura $factura)
    {
        $this->factura->removeElement($factura);
    }

    /**
     * Get factura
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getFactura()
    {
        return $this->factura;
    }
    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $detalle_producto;


    /**
     * Add detalleProducto
     *
     * @param \Wbc\AdministratorBundle\Entity\DetalleProducto $detalleProducto
     *
     * @return Compra
     */
    public function addDetalleProducto(\Wbc\AdministratorBundle\Entity\DetalleProducto $detalleProducto)
    {
        $this->detalle_producto[] = $detalleProducto;

        return $this;
    }

    /**
     * Remove detalleProducto
     *
     * @param \Wbc\AdministratorBundle\Entity\DetalleProducto $detalleProducto
     */
    public function removeDetalleProducto(\Wbc\AdministratorBundle\Entity\DetalleProducto $detalleProducto)
    {
        $this->detalle_producto->removeElement($detalleProducto);
    }

    /**
     * Get detalleProducto
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getDetalleProducto()
    {
        return $this->detalle_producto;
    }
}
