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

    public function __construct($userEntity, $em) {

        $this->clienteEntity = $userEntity;
        $this->_em = $em;
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

}
