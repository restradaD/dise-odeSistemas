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
class EncargadoFinanzas {

    private $_em;

    public function __construct($em) {

        $this->_em = $em;
    }

    /**
     * Paga a un empleado guarda el registro
     * @param object $pagoEmpleado
     * @return boolean
     */
    public function pagarEmpleado($pagoEmpleado) {

        try {
            $now = new \DateTime('now');
            $pagoEmpleado->setCreacion($now);

            $this->_em->persist($pagoEmpleado);
            $this->_em->flush();

            return $pagoEmpleado;
        } catch (Exception $ex) {
            $this->errorMessage = $ex->getMessage();
            return false;
        }
    }

}
