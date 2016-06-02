<?php

namespace Wbc\AdministratorBundle\Entity;

/**
 * TipoPago
 */
class TipoPago
{
    /**
     * @var int
     */
    private $id;

    /**
     * @var string
     */
    private $nombre;

    /**
     * @var string
     */
    private $descripcion;
    
    
    public function __toString() {
        return $this->nombre;
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
     * Set nombre
     *
     * @param string $nombre
     *
     * @return TipoPago
     */
    public function setNombre($nombre)
    {
        $this->nombre = $nombre;

        return $this;
    }

    /**
     * Get nombre
     *
     * @return string
     */
    public function getNombre()
    {
        return $this->nombre;
    }

    /**
     * Set descripcion
     *
     * @param string $descripcion
     *
     * @return TipoPago
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
     * Set id
     *
     * @param integer $id
     *
     * @return TipoPago
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
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
     * @return TipoPago
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
}
