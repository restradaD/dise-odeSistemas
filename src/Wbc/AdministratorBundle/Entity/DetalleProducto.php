<?php

namespace Wbc\AdministratorBundle\Entity;

/**
 * DetalleProducto
 */
class DetalleProducto
{
    /**
     * @var int
     */
    private $id;

    /**
     * @var string
     */
    private $precioUnidad;

    /**
     * @var int
     */
    private $cantidad;

    /**
     * @var int
     */
    private $tipoOperacion;

    /**
     * @var string
     */
    private $total;

    /**
     * @var \DateTime
     */
    private $creacion;
    
    
    public function __toString() {
        return $this->producto->getNombre();
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
     * Set precioUnidad
     *
     * @param string $precioUnidad
     *
     * @return DetalleProducto
     */
    public function setPrecioUnidad($precioUnidad)
    {
        $this->precioUnidad = $precioUnidad;

        return $this;
    }

    /**
     * Get precioUnidad
     *
     * @return string
     */
    public function getPrecioUnidad()
    {
        return $this->precioUnidad;
    }

    /**
     * Set cantidad
     *
     * @param integer $cantidad
     *
     * @return DetalleProducto
     */
    public function setCantidad($cantidad)
    {
        $this->cantidad = $cantidad;

        return $this;
    }

    /**
     * Get cantidad
     *
     * @return int
     */
    public function getCantidad()
    {
        return $this->cantidad;
    }

    /**
     * Set tipoOperacion
     *
     * @param integer $tipoOperacion
     *
     * @return DetalleProducto
     */
    public function setTipoOperacion($tipoOperacion)
    {
        $this->tipoOperacion = $tipoOperacion;

        return $this;
    }

    /**
     * Get tipoOperacion
     *
     * @return int
     */
    public function getTipoOperacion()
    {
        return $this->tipoOperacion;
    }

    /**
     * Set total
     *
     * @param string $total
     *
     * @return DetalleProducto
     */
    public function setTotal($total)
    {
        $this->total = $total;

        return $this;
    }

    /**
     * Get total
     *
     * @return string
     */
    public function getTotal()
    {
        return $this->total;
    }

    /**
     * Set creacion
     *
     * @param \DateTime $creacion
     *
     * @return DetalleProducto
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
     * @var \Wbc\AdministratorBundle\Entity\Producto
     */
    private $producto;

    /**
     * @var \Wbc\AdministratorBundle\Entity\Compra
     */
    private $compra;

    /**
     * @var \Wbc\AdministratorBundle\Entity\Venta
     */
    private $venta;


    /**
     * Set producto
     *
     * @param \Wbc\AdministratorBundle\Entity\Producto $producto
     *
     * @return DetalleProducto
     */
    public function setProducto(\Wbc\AdministratorBundle\Entity\Producto $producto)
    {
        $this->producto = $producto;

        return $this;
    }

    /**
     * Get producto
     *
     * @return \Wbc\AdministratorBundle\Entity\Producto
     */
    public function getProducto()
    {
        return $this->producto;
    }

    /**
     * Set compra
     *
     * @param \Wbc\AdministratorBundle\Entity\Compra $compra
     *
     * @return DetalleProducto
     */
    public function setCompra(\Wbc\AdministratorBundle\Entity\Compra $compra = null)
    {
        $this->compra = $compra;

        return $this;
    }

    /**
     * Get compra
     *
     * @return \Wbc\AdministratorBundle\Entity\Compra
     */
    public function getCompra()
    {
        return $this->compra;
    }

    /**
     * Set venta
     *
     * @param \Wbc\AdministratorBundle\Entity\Venta $venta
     *
     * @return DetalleProducto
     */
    public function setVenta(\Wbc\AdministratorBundle\Entity\Venta $venta = null)
    {
        $this->venta = $venta;

        return $this;
    }

    /**
     * Get venta
     *
     * @return \Wbc\AdministratorBundle\Entity\Venta
     */
    public function getVenta()
    {
        return $this->venta;
    }
}
