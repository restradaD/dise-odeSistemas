<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Wbc\AdministratorBundle\Model;

/**
 * Description of Cliente
 *
 * @author rene
 */
class EncargadoRH {

    private $_em;

    public function __construct($em) {

        $this->_em = $em;
    }

    /**
     * Guarda edicion de empleado
     * @param object $empleado
     * @return boolean
     */
    public function administrarEmpleados($empleado) {

        try {
            $this->_em->persist($empleado);
            $this->_em->flush();

            return $empleado;
        } catch (Exception $ex) {
            $this->errorMessage = $ex->getMessage();
            return false;
        }
    }

    /**
     * Edita un pago a empleados
     * @param object $pagoEmpleado
     */
    public function administrarSalarios($pagoEmpleado) {

        $this->_em->persist($pagoEmpleado);
        $this->_em->flush();
    }

    /**
     * Crea un registro en beneficio flush
     * @param object $beneficio
     * @return object
     */
    public function administrarPrestaciones($beneficio) {

        try {

            $now = new \DateTime('now');
            $beneficio->setFechaCreacion($now);

            $this->_em->persist($beneficio);
            $this->_em->flush();

            return $beneficio;
        } catch (Exception $ex) {
            $this->errorMessage = $ex->getMessage();
            return false;
        }
    }

}
