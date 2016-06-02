<?php

namespace Wbc\AdministratorBundle\Entity;

/**
 * Factura
 */
class Factura
{
    /**
     * @var int
     */
    private $id;

    /**
     * @var string
     */
    private $total;

    /**
     * @var string
     */
    private $descripcion;

    /**
     * @var \DateTime
     */
    private $creacion;
    
    
    public function __toString() {
        return $this->total. ' ';
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
     * Set total
     *
     * @param string $total
     *
     * @return Factura
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
     * Set descripcion
     *
     * @param string $descripcion
     *
     * @return Factura
     */
    public function setDescripcion($descripcion)
    {
        $this->descripcion = $descripcion;

        return $this;
    }

    /**
     * Get descripcion
     *
     * @return string
     */
    public function getDescripcion()
    {
        return $this->descripcion;
    }

    /**
     * Set creacion
     *
     * @param \DateTime $creacion
     *
     * @return Factura
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
     * @var integer
     */
    private $tipo_operacion;

    /**
     * @var \Wbc\AdministratorBundle\Entity\TipoPago
     */
    private $tipo_pago;

    /**
     * @var \Wbc\AdministratorBundle\Entity\Compra
     */
    private $compra;

    /**
     * @var \Wbc\AdministratorBundle\Entity\Venta
     */
    private $venta;


    /**
     * Set tipoOperacion
     *
     * @param integer $tipoOperacion
     *
     * @return Factura
     */
    public function setTipoOperacion($tipoOperacion)
    {
        $this->tipo_operacion = $tipoOperacion;

        return $this;
    }

    /**
     * Get tipoOperacion
     *
     * @return integer
     */
    public function getTipoOperacion()
    {
        return $this->tipo_operacion;
    }

    /**
     * Set tipoPago
     *
     * @param \Wbc\AdministratorBundle\Entity\TipoPago $tipoPago
     *
     * @return Factura
     */
    public function setTipoPago(\Wbc\AdministratorBundle\Entity\TipoPago $tipoPago)
    {
        $this->tipo_pago = $tipoPago;

        return $this;
    }

    /**
     * Get tipoPago
     *
     * @return \Wbc\AdministratorBundle\Entity\TipoPago
     */
    public function getTipoPago()
    {
        return $this->tipo_pago;
    }

    /**
     * Set compra
     *
     * @param \Wbc\AdministratorBundle\Entity\Compra $compra
     *
     * @return Factura
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
     * @return Factura
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
