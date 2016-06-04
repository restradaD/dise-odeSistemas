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

    /**
     * Trae el listado de productos por factura de ventas 
     * @param int $ventaId
     * @return array
     */
    public function generarReporteDeVentas($ventaId) {

        $query = $this->_em->createQuery("SELECT p.id, p.nombre, p.precioVenta, p.descripcion FROM Wbc\AdministratorBundle\Entity\DetalleProducto dp JOIN dp.venta v JOIN dp.producto p WHERE v.id = :ventaId ORDER BY p.nombre ASC");
        $query->setParameter('ventaId', $ventaId);
        $data = $query->getResult();

        if (empty($data)) {
            return null;
        }
        return $data;
    }

}
