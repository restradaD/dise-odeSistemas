<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Wbc\AdministratorBundle\Model;

use Wbc\AdministratorBundle\Entity\Venta;

/**
 * Description of Cliente
 *
 * @author rene
 */
class Producto {

    //put your code here

    private $clienteEntity;
    private $_em;
    public $errorMessage;

    public function __construct($em, $userEntity = null) {

        $this->clienteEntity = $userEntity;
        $this->_em = $em;
    }

    /**
     * Trae todos los productos para agregarlos al catalogo de productos
     * @return array
     */
    public function aplicarOferta() {
        $productos = $this->_em->getRepository('WbcAdministratorBundle:Producto')->findAll();

        return $productos;
    }

    /**
     * Agrega un nuevo producto en la bd
     * @param object $producto
     * @return boolean
     */
    public function Comprar($producto) {

        $now = new \DateTime('now');
        $producto->setFechaCreacion($now);

        $this->_em->persist($producto);
        $this->_em->flush();

        return true;
    }

    /**
     * Crea un registro en entidad venta y la retorna
     * @return boolean|Venta
     */
    public function vender() {

        try {

            $venta = new Venta();
            $fecha = new \DateTime('now');

            $venta->setUser($this->clienteEntity);
            $venta->setCreacion($fecha);

            $this->_em->persist($venta);

            return $venta;
        } catch (Exception $ex) {
            $this->errorMessage = $ex->getMessage();
            return false;
        }
    }

    /**
     * Edita producto en bd
     * @param object $producto
     * @return object
     */
    public function administrarProducto($producto) {

        $this->_em->persist($producto);
        $this->_em->flush();

        return $producto;
    }

    /**
     * Edita un certificado
     * @param object $certificado
     * @return boolean
     */
    public function administrarCertificado($certificado) {

        try {

            $this->_em->persist($certificado);
            $this->_em->flush();
        } catch (Exception $ex) {
            $this->errorMessage = $ex->getMessage();
            return false;
        }
    }

}
