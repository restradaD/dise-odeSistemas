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
class Gerente {

    private $_em;

    public function __construct($em) {
        $this->_em = $em;
    }

    /**
     * Trae listado de todos los producto
     * @return array
     */
    public function generarReporteCompras() {

        $productos = $this->_em->getRepository('WbcAdministratorBundle:Producto')->findAll();

        return $productos;
    }

    /**
     * Trae todos los empleados
     * @return array
     */
    public function generarReportePlanilla() {

        $empleados = $this->_em->getRepository('WbcAdministratorBundle:Empleado')->findAll();

        return $empleados;
    }

}
