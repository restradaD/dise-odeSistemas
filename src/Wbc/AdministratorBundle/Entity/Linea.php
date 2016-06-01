<?php

namespace Wbc\AdministratorBundle\Entity;

/**
 * Linea
 */
class Linea
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
     * @return Linea
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
     * @return Linea
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
     * @var \Doctrine\Common\Collections\Collection
     */
    private $linea_producto;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->linea_producto = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add lineaProducto
     *
     * @param \Wbc\AdministratorBundle\Entity\LineaProducto $lineaProducto
     *
     * @return Linea
     */
    public function addLineaProducto(\Wbc\AdministratorBundle\Entity\LineaProducto $lineaProducto)
    {
        $this->linea_producto[] = $lineaProducto;

        return $this;
    }

    /**
     * Remove lineaProducto
     *
     * @param \Wbc\AdministratorBundle\Entity\LineaProducto $lineaProducto
     */
    public function removeLineaProducto(\Wbc\AdministratorBundle\Entity\LineaProducto $lineaProducto)
    {
        $this->linea_producto->removeElement($lineaProducto);
    }

    /**
     * Get lineaProducto
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getLineaProducto()
    {
        return $this->linea_producto;
    }
}
