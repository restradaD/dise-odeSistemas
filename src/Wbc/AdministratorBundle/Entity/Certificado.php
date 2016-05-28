<?php

namespace Wbc\AdministratorBundle\Entity;

/**
 * Certificado
 */
class Certificado
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

    /**
     * @var string
     */
    private $terminoCondicion;

    /**
     * @var \DateTime
     */
    private $iniciaVigencia;

    /**
     * @var \DateTime
     */
    private $finVigencia;

    /**
     * @var \DateTime
     */
    private $fechaCreacion;
    
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
     * @return Certificado
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
     * @return Certificado
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
     * Set terminoCondicion
     *
     * @param string $terminoCondicion
     *
     * @return Certificado
     */
    public function setTerminoCondicion($terminoCondicion)
    {
        $this->terminoCondicion = $terminoCondicion;

        return $this;
    }

    /**
     * Get terminoCondicion
     *
     * @return string
     */
    public function getTerminoCondicion()
    {
        return $this->terminoCondicion;
    }

    /**
     * Set iniciaVigencia
     *
     * @param \DateTime $iniciaVigencia
     *
     * @return Certificado
     */
    public function setIniciaVigencia($iniciaVigencia)
    {
        $this->iniciaVigencia = $iniciaVigencia;

        return $this;
    }

    /**
     * Get iniciaVigencia
     *
     * @return \DateTime
     */
    public function getIniciaVigencia()
    {
        return $this->iniciaVigencia;
    }

    /**
     * Set finVigencia
     *
     * @param \DateTime $finVigencia
     *
     * @return Certificado
     */
    public function setFinVigencia($finVigencia)
    {
        $this->finVigencia = $finVigencia;

        return $this;
    }

    /**
     * Get finVigencia
     *
     * @return \DateTime
     */
    public function getFinVigencia()
    {
        return $this->finVigencia;
    }

    /**
     * Set fechaCreacion
     *
     * @param \DateTime $fechaCreacion
     *
     * @return Certificado
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
     * @var \Wbc\AdministratorBundle\Entity\Producto
     */
    private $producto;


    /**
     * Set producto
     *
     * @param \Wbc\AdministratorBundle\Entity\Producto $producto
     *
     * @return Certificado
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
