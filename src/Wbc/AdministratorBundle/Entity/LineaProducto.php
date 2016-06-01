<?php

namespace Wbc\AdministratorBundle\Entity;

/**
 * LineaProducto
 */
class LineaProducto
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
        return $this->producto->getNombre(). ' ' . $this->linea->getNombre();
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
     * @return LineaProducto
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
     * @var \Wbc\AdministratorBundle\Entity\Linea
     */
    private $linea;

    /**
     * @var \Wbc\AdministratorBundle\Entity\Producto
     */
    private $producto;


    /**
     * Set linea
     *
     * @param \Wbc\AdministratorBundle\Entity\Linea $linea
     *
     * @return LineaProducto
     */
    public function setLinea(\Wbc\AdministratorBundle\Entity\Linea $linea)
    {
        $this->linea = $linea;

        return $this;
    }

    /**
     * Get linea
     *
     * @return \Wbc\AdministratorBundle\Entity\Linea
     */
    public function getLinea()
    {
        return $this->linea;
    }

    /**
     * Set producto
     *
     * @param \Wbc\AdministratorBundle\Entity\Producto $producto
     *
     * @return LineaProducto
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
}
