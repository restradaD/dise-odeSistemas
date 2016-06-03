<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Wbc\AdministratorBundle\Model;

use Wbc\AdministratorBundle\Entity\DetalleProducto;

/**
 * Description of Cliente
 *
 * @author rene
 */
class EncargadoCompras {
 
    private $cantidad;
    private $ventaEntity; 
    public $errorMessage;
    private $_em;

    public function __construct($em, $cantidad = null, $venta = null) {

        
        $this->ventaEntity = $venta;
        $this->cantidad = $cantidad;
        $this->_em = $em;
    }
    
    
    /**
     * Crea un registro en entidad DetalleProducto y lo retorna por cada producto vendido en una misma factura
     * @param type $producto
     * @return boolean|DetalleProducto
     */
    public function comprarProducto($producto) {

        try {

            $detalleProducto = new DetalleProducto();
            $fecha = new \DateTime('now');

            $detalleProducto->setPrecioUnidad($producto->getPrecioVenta());
            $detalleProducto->setCantidad($this->cantidad);
            $detalleProducto->setTotal($producto->getPrecioVenta());
            $detalleProducto->setCreacion($fecha);
            $detalleProducto->setTipoOperacion(2);
            $detalleProducto->setProducto($producto);
            $detalleProducto->setVenta($this->ventaEntity);

            $this->_em->persist($detalleProducto);
 
            return $detalleProducto;
        } catch (Exception $ex) {
            $this->errorMessage = $ex->getMessage();
            return false;
        }
    }

    /**
     * Aplica la edicion de un proveedor
     * @param object $proveedor
     * @return boolean|object
     */
    public function gestionarProveedores($proveedor) {

        try {

            $this->_em->persist($proveedor);
            $this->_em->flush();

            return $proveedor;
        } catch (Exception $ex) {
            $this->errorMessage = $ex->getMessage();
            return false;
        }
    }

}
