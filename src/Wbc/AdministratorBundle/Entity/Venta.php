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
     * @return Venta
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
     * @return Venta
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
