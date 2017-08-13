<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of UsuarioDTO
 *
 * @author miuguel
 */
class UsuarioDTO {
    private $usuario;
    private $contra;
    private $nombres;
    private $apellidos;
    
    function getUsuario() {
        return $this->usuario;
    }

    function getContra() {
        return $this->contra;
    }

    function setUsuario($usuario) {
        $this->usuario = $usuario;
    }

    function setContra($contra) {
        $this->contra = $contra;
    }
    
    function getNombres() {
        return $this->nombres;
    }

    function getApellidos() {
        return $this->apellidos;
    }

    function setNombres($nombres) {
        $this->nombres = $nombres;
    }

    function setApellidos($apellidos) {
        $this->apellidos = $apellidos;
    }



}
