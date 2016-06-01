<?php

namespace Wbc\AdministratorBundle\Entity;

/**
 * Proveedor
 */
class Proveedor
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
    private $telefono;

    /**
     * @var string
     */
    private $correo;

    /**
     * @var string
     */
    private $direccion;

    /**
     * @var string
     */
    private $nit;

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
     * @return Proveedor
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
     * Set telefono
     *
     * @param string $telefono
     *
     * @return Proveedor
     */
    public function setTelefono($telefono)
    {
        $this->telefono = $telefono;

        return $this;
    }

    /**
     * Get telefono
     *
     * @return string
     */
    public function getTelefono()
    {
        return $this->telefono;
    }

    /**
     * Set correo
     *
     * @param string $correo
     *
     * @return Proveedor
     */
    public function setCorreo($correo)
    {
        $this->correo = $correo;

        return $this;
    }

    /**
     * Get correo
     *
     * @return string
     */
    public function getCorreo()
    {
        return $this->correo;
    }

    /**
     * Set direccion
     *
     * @param string $direccion
     *
     * @return Proveedor
     */
    public function setDireccion($direccion)
    {
        $this->direccion = $direccion;

        return $this;
    }

    /**
     * Get direccion
     *
     * @return string
     */
    public function getDireccion()
    {
        return $this->direccion;
    }

    /**
     * Set nit
     *
     * @param string $nit
     *
     * @return Proveedor
     */
    public function setNit($nit)
    {
        $this->nit = $nit;

        return $this;
    }

    /**
     * Get nit
     *
     * @return string
     */
    public function getNit()
    {
        return $this->nit;
    }

    /**
     * Set fechaCreacion
     *
     * @param \DateTime $fechaCreacion
     *
     * @return Proveedor
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
     * @var \Doctrine\Common\Collections\Collection
     */
    private $compra;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->compra = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add compra
     *
     * @param \Wbc\AdministratorBundle\Entity\Compra $compra
     *
     * @return Proveedor
     */
    public function addCompra(\Wbc\AdministratorBundle\Entity\Compra $compra)
    {
        $this->compra[] = $compra;

        return $this;
    }

    /**
     * Remove compra
     *
     * @param \Wbc\AdministratorBundle\Entity\Compra $compra
     */
    public function removeCompra(\Wbc\AdministratorBundle\Entity\Compra $compra)
    {
        $this->compra->removeElement($compra);
    }

    /**
     * Get compra
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getCompra()
    {
        return $this->compra;
    }
}
