<?php

namespace Wbc\AdministratorBundle\Entity;

/**
 * Beneficio
 */
class Beneficio
{
    /**
     * @var int
     */
    private $id;

    /**
     * @var string
     */
    private $bono14;

    /**
     * @var string
     */
    private $aguinaldo;

    /**
     * @var string
     */
    private $bonificacionIncentivo;

    /**
     * @var string
     */
    private $descripcion;

    /**
     * @var \DateTime
     */
    private $fechaCreacion;

    public function __toString() {
        return $this->descripcion;
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
     * Set bono14
     *
     * @param string $bono14
     *
     * @return Beneficio
     */
    public function setBono14($bono14)
    {
        $this->bono14 = $bono14;

        return $this;
    }

    /**
     * Get bono14
     *
     * @return string
     */
    public function getBono14()
    {
        return $this->bono14;
    }

    /**
     * Set aguinaldo
     *
     * @param string $aguinaldo
     *
     * @return Beneficio
     */
    public function setAguinaldo($aguinaldo)
    {
        $this->aguinaldo = $aguinaldo;

        return $this;
    }

    /**
     * Get aguinaldo
     *
     * @return string
     */
    public function getAguinaldo()
    {
        return $this->aguinaldo;
    }

    /**
     * Set bonificacionIncentivo
     *
     * @param string $bonificacionIncentivo
     *
     * @return Beneficio
     */
    public function setBonificacionIncentivo($bonificacionIncentivo)
    {
        $this->bonificacionIncentivo = $bonificacionIncentivo;

        return $this;
    }

    /**
     * Get bonificacionIncentivo
     *
     * @return string
     */
    public function getBonificacionIncentivo()
    {
        return $this->bonificacionIncentivo;
    }

    /**
     * Set descripcion
     *
     * @param string $descripcion
     *
     * @return Beneficio
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
     * @return Beneficio
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
    private $empleado;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->empleado = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add empleado
     *
     * @param \Wbc\AdministratorBundle\Entity\Empleado $empleado
     *
     * @return Beneficio
     */
    public function addEmpleado(\Wbc\AdministratorBundle\Entity\Empleado $empleado)
    {
        $this->empleado[] = $empleado;

        return $this;
    }

    /**
     * Remove empleado
     *
     * @param \Wbc\AdministratorBundle\Entity\Empleado $empleado
     */
    public function removeEmpleado(\Wbc\AdministratorBundle\Entity\Empleado $empleado)
    {
        $this->empleado->removeElement($empleado);
    }

    /**
     * Get empleado
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getEmpleado()
    {
        return $this->empleado;
    }
}
