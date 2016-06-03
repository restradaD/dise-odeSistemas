<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Wbc\AdministratorBundle\Model;

use Wbc\AdministratorBundle\Model\Producto;
use Wbc\AdministratorBundle\Model\CompraProducto;
use Wbc\AdministratorBundle\Model\Factura;

/**
 * Description of Cliente
 *
 * @author rene
 */
class Cliente {

    //put your code here

    private $clienteEntity;
    private $_em;
    public $errorMessage;
    public $total = 0;

    public function __construct($userEntity, $em) {

        $this->clienteEntity = $userEntity;
        $this->_em = $em;
    }
    
    /**
     * Trae los datos de un producto
     * @param int $productoId
     * @return object
     */
    public function consultarProducto($productoId){
        $producto = $this->_em->getRepository('WbcAdministratorBundle:Producto')->findOneById($productoId);
        
        return $producto;
    }

    /**
     * Genera factura a partir de una venta del sistema
     * @param type $procutos
     * @return array
     */
    public function comprarPruductos($procutos) {

        $productoClass = new Producto($this->_em, $this->clienteEntity);

        $venta = $productoClass->vender();

        $detalleProducto = new CompraProducto(1, $venta, $this->_em);
        if (is_array($procutos)) {

            foreach ($procutos as $procutoId) {
                $producto = $this->_em->getRepository('WbcAdministratorBundle:Producto')->findOneById($procutoId);
                $producto->setExistencia(intval($producto->getExistencia()) - 1);
                $this->_em->persist($producto);
                $this->_em->flush();
                $this->total += intval($producto->getPrecioVenta());

                $detalleProducto->comprarProducto($producto);
            }
        } else {
            $producto = $this->_em->getRepository('WbcAdministratorBundle:Producto')->findOneById($procutos);
            $producto->setExistencia(intval($producto->getExistencia()) - 1);
            $this->_em->persist($producto);
            $this->total = intval($producto->getPrecioVenta());

            $detalleProducto->comprarProducto($producto);
        }

        $factura = new Factura($this->_em, $venta, $this->total);

        $factura->generarFactura();

        $this->_em->flush();


        return ['total' => $this->total];
    }

}
