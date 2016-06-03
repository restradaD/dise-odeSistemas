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

}
