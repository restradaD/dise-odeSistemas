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
class Pago {

    private $_em;

    public function __construct($em) {

        $this->_em = $em;
    }

    /**
     * Retorna el tipo de pago con targeta de credito
     * @return entity|boolean
     */
    public function pagarPorTargetaCredito() {

        try {

            $pagoTargeta = $this->_em->getRepository('WbcAdministratorBundle:TipoPago')->findOneById(1);

            return $pagoTargeta;
        } catch (Exception $ex) {
            $this->errorMessage = $ex->getMessage();
            return false;
        }
    }

}
