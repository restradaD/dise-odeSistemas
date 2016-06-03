<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Wbc\AdministratorBundle\Model;

use Wbc\AdministratorBundle\Model\Pago;

/**
 * Description of Cliente
 *
 * @author rene
 */
class Factura {

    //put your code here

    public $_em;
    public $errorMessage;
    public $ventaEntity;
    public $total;

    public function __construct($em, $venta = null, $total = null) {

        $this->ventaEntity = $venta;
        $this->_em = $em;
        $this->total = $total;
    }

    /**
     * Crea un registro de una factura sobre una venta de productos
     * @return boolean|\Wbc\AdministratorBundle\Entity\Factura
     */
    public function generarFactura() {

        try {

            $factura = new \Wbc\AdministratorBundle\Entity\Factura();
            $fecha = new \DateTime('now');
            $pagoClass = new Pago($this->_em);

            $pagoConTargeta = $pagoClass->pagarPorTargetaCredito();

            $factura->setTotal($this->total);
            $factura->setTipoOperacion(2);
            $factura->setDescripcion('Compra de productos por parte de un usuario');
            $factura->setCreacion($fecha);
            $factura->setTipoPago($pagoConTargeta);
            $factura->setVenta($this->ventaEntity);


            $this->_em->persist($factura);

            return $factura;
        } catch (Exception $ex) {
            $this->errorMessage = $ex->getMessage();
            return false;
        }
    }

    /**
     * Genera un nuevo certificado para un producto
     * @param object $certificado
     * @return object
     */
    public function generarCertificado($certificado) {

        $now = new \DateTime('now');
        $certificado->setFechaCreacion($now);

        $this->_em->persist($certificado);
        $this->_em->flush();

        return $certificado;
    }

    private function pagarProductos() {
        
    }

}
