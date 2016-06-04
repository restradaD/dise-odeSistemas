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
class EncargadoLogistica {

    private $_em;

    public function __construct($em) {
        $this->_em = $em;
    }

    /**
     * Trae listado de todos los usuarios
     * @return array
     */
    public function consultarClientes() {

        $users = $this->_em->getRepository('WbcAdministratorBundle:User')->findAll();

        return $users;
    }

    /**
     * Listado de todas las ventas realizadas y factura
     * @return array
     */
    public function generarReporteDeVentas() {

        $query = $this->_em->createQuery("SELECT f.id facturaId, f.creacion, f.total, v.id ventaId, u.first_name, u.last_name FROM Wbc\AdministratorBundle\Entity\Factura f JOIN f.venta v JOIN v.user u ORDER BY f.id ASC");

        $data = $query->getResult();

        if (empty($data)) {
            return null;
        }
        return $data;
    }

}
