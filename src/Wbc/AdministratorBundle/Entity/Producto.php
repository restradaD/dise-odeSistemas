<?php

namespace Wbc\AdministratorBundle\Entity;

/**
 * Producto
 */
class Producto
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
    private $precioVenta;

    /**
     * @var string
     */
    private $precioCompra;

    /**
     * @var int
     */
    private $existencia;

    /**
     * @var string
     */
    private $imagen;

    /**
     * @var string
     */
    private $descripcion;

    /**
     * @var \DateTime
     */
    private $fechaCreacion;

    /**
     * @var \DateTime
     */
    private $fechaEdicion;
    
    
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
     * @return Producto
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
     * Set precioVenta
     *
     * @param string $precioVenta
     *
     * @return Producto
     */
    public function setPrecioVenta($precioVenta)
    {
        $this->precioVenta = $precioVenta;

        return $this;
    }

    /**
     * Get precioVenta
     *
     * @return string
     */
    public function getPrecioVenta()
    {
        return $this->precioVenta;
    }

    /**
     * Set precioCompra
     *
     * @param string $precioCompra
     *
     * @return Producto
     */
    public function setPrecioCompra($precioCompra)
    {
        $this->precioCompra = $precioCompra;

        return $this;
    }

    /**
     * Get precioCompra
     *
     * @return string
     */
    public function getPrecioCompra()
    {
        return $this->precioCompra;
    }

    /**
     * Set existencia
     *
     * @param integer $existencia
     *
     * @return Producto
     */
    public function setExistencia($existencia)
    {
        $this->existencia = $existencia;

        return $this;
    }

    /**
     * Get existencia
     *
     * @return int
     */
    public function getExistencia()
    {
        return $this->existencia;
    }

    /**
     * Set imagen
     *
     * @param string $imagen
     *
     * @return Producto
     */
    public function setImagen($imagen)
    {
        $this->imagen = $imagen;

        return $this;
    }

    /**
     * Get imagen
     *
     * @return string
     */
    public function getImagen()
    {
        return $this->imagen;
    }

    /**
     * Set descripcion
     *
     * @param string $descripcion
     *
     * @return Producto
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
     * Set fechaCreacion
     *
     * @param \DateTime $fechaCreacion
     *
     * @return Producto
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
     * Set fechaEdicion
     *
     * @param \DateTime $fechaEdicion
     *
     * @return Producto
     */
    public function setFechaEdicion($fechaEdicion)
    {
        $this->fechaEdicion = $fechaEdicion;

        return $this;
    }

    /**
     * Get fechaEdicion
     *
     * @return \DateTime
     */
    public function getFechaEdicion()
    {
        return $this->fechaEdicion;
    }
    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $certificado;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->certificado = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add certificado
     *
     * @param \Wbc\AdministratorBundle\Entity\Certificado $certificado
     *
     * @return Producto
     */
    public function addCertificado(\Wbc\AdministratorBundle\Entity\Certificado $certificado)
    {
        $this->certificado[] = $certificado;

        return $this;
    }

    /**
     * Remove certificado
     *
     * @param \Wbc\AdministratorBundle\Entity\Certificado $certificado
     */
    public function removeCertificado(\Wbc\AdministratorBundle\Entity\Certificado $certificado)
    {
        $this->certificado->removeElement($certificado);
    }

    /**
     * Get certificado
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getCertificado()
    {
        return $this->certificado;
    }
    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $linea_producto;


    /**
     * Add lineaProducto
     *
     * @param \Wbc\AdministratorBundle\Entity\LineaProducto $lineaProducto
     *
     * @return Producto
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
