<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Egreso
 *
 * @author miuguel
 */
class EgresoDTO {
    private $egreso;
    private $fechaMov;
    private $valor;
    private $contrato;
    
    function __construct($egreso, $fechaMov, $valor) {
        $this->egreso = $egreso;
        $this->fechaMov = $fechaMov;
        $this->valor = $valor;
    }

    
    function getEgreso() {
        return $this->egreso;
    }

    function getFechaMov() {
        return $this->fechaMov;
    }

    function getValor() {
        return $this->valor;
    }

    function setEgreso($egreso) {
        $this->egreso = $egreso;
    }

    function setFechaMov($fechaMov) {
        $this->fechaMov = $fechaMov;
    }

    function setValor($valor) {
        $this->valor = $valor;
    }
    function getContrato() {
        return $this->contrato;
    }

    function setContrato($contrato) {
        $this->contrato = $contrato;
    }


}
