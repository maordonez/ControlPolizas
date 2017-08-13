<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ContratoDTO
 *
 * @author miuguel
 */
class ContratoDTO {

    /**
     *
     * @var String 
     */
    private $idContrato;

    /**
     *
     * @var String 
     */
    private $objetoContrato;

    /**
     *
     * @var String 
     */
    private $tipoContrato;

    /**
     *
     * @var String 
     */
    private $modalidadContrato;
    private $contratistaNit;
    private $contratistaRazonSocial;
    private $tipoContratista;
    private $supervisorNit;
    private $supervisorRazonSocial;
    private $tipoSupervisor;
    private $tipoVinculacion;
    private $rubro;

    /**
     *
     * @var Double 
     */
    private $valorContrato;

    /**
     *
     * @var Double 
     */
    private $valorAnticipo;

    /**
     *
     * @var Array 
     */
    private $etapa;

    /**
     *
     * @var String 
     */
    private $planGobierno;

    /**
     *
     * @var String 
     */
    private $ciudad;

    /**
     *
     * @var String 
     */
    private $departamento;
    private $modificacion;
    private $fechaInicio;
    private $fechaSuscripcion;
    private $fechaFin;
    private $pactoAnticipo;
    private $contituyoFiducia;
    private $faseContratacion;
    private $numeroCdp;
    private $fechaCdp;
    private $valorCdp;
    private $numeroCdp2;
    private $fechaCdp2;
    private $valorCdp2;
    private $egresos;
    private $vigencia;

    function __construct() {
        //contrato
        $this->idContrato = '';
        $this->objetoContrato = null;
        $this->departamento = null;
        $this->modificacion = '';
        $this->fechaInicio = null;
        $this->fechaSuscripcion = null;
        $this->pactoAnticipo = null;
        $this->contituyoFiducia = null;
        $this->rubro = null;
        $this->valorContrato = null;
        $this->valorAnticipo = null;
        $this->ciudad = null;
        //foraneas
        $this->modalidadContrato = null;
        $this->etapa = null;
        $this->planGobierno = null;
        //contratista
        $this->contratistaNit = null;
        $this->contratistaRazonSocial = null;
        $this->tipoContratista = null;
        //supervisor
        $this->supervisorNit = null;
        $this->supervisorRazonSocial = null;
        $this->tipoSupervisor = null;
        $this->tipoVinculacion = null;


        $this->egresos = null;
        $this->vigencia = null;
        //compromisos
        $this->faseContratacion = null;
        $this->numeroCdp = null;
        $this->fechaCdp = null;
        $this->valorCdp = null;

        $this->numeroCdp2 = null;
        $this->fechaCdp2 = null;
        $this->valorCdp2 = null;
    }

    function getIdContrato() {
        return $this->idContrato;
    }

    function getObjetoContrato() {
        return $this->objetoContrato;
    }

    function getTipoContrato() {
        return $this->tipoContrato;
    }

    function getModalidadContrato() {
        return $this->modalidadContrato;
    }

    function getValorContrato() {
        return $this->valorContrato;
    }

    function getValorAnticipo() {
        return $this->valorAnticipo;
    }

    function getEtapa() {
        return $this->etapa;
    }

    function getPlanGobierno() {
        return $this->planGobierno;
    }

    function getCiudad() {
        return $this->ciudad;
    }

    function getDepartamento() {
        return $this->departamento;
    }

    function setIdContrato($idContrato) {
        $this->idContrato = $idContrato;
    }

    function setObjetoContrato($objetoContrato) {
        $this->objetoContrato = $objetoContrato;
    }

    function setTipoContrato($tipoContrato) {
        $this->tipoContrato = $tipoContrato;
    }

    function setModalidadContrato($modalidadContrato) {
        $this->modalidadContrato = $modalidadContrato;
    }

    function setValorContrato($valorContrato) {
        $this->valorContrato = $valorContrato;
    }

    function setValorAnticipo($valorAnticipo) {
        $this->valorAnticipo = $valorAnticipo;
    }

    function setEtapa($etapa) {
        $this->etapa = $etapa;
    }

    function setPlanGobierno($planGobierno) {
        $this->planGobierno = $planGobierno;
    }

    function setCiudad($ciudad) {
        $this->ciudad = $ciudad;
    }

    function setDepartamento($departamento) {
        $this->departamento = $departamento;
    }

    function getModificacion() {
        return $this->modificacion;
    }

    function setModificacion($modificacion) {
        $this->modificacion = $modificacion;
    }

    function getContratistaNit() {
        return $this->contratistaNit;
    }

    function getContratistaRazonSocial() {
        return $this->contratistaRazonSocial;
    }

    function setContratistaNit($contratistaNit) {
        $this->contratistaNit = $contratistaNit;
    }

    function setContratistaRazonSocial($contratistaRazonSocial) {
        $this->contratistaRazonSocial = $contratistaRazonSocial;
    }

    function getFechaInicio() {
        return $this->fechaInicio;
    }

    function setFechaInicio($fechaInicio) {
        $this->fechaInicio = $fechaInicio;
    }

    function getTipoContratista() {
        return $this->tipoContratista;
    }

    function setTipoContratista($tipoContratista) {
        $this->tipoContratista = $tipoContratista;
    }

    function getRubro() {
        return $this->rubro;
    }

    function setRubro($rubro) {
        $this->rubro = $rubro;
    }

    function getFechaSuscripcion() {
        return $this->fechaSuscripcion;
    }

    function setFechaSuscripcion($fechaSuscripcion) {
        $this->fechaSuscripcion = $fechaSuscripcion;
    }

    function getPactoAnticipo() {
        return $this->pactoAnticipo;
    }

    function setPactoAnticipo($pactoAnticipo) {
        $this->pactoAnticipo = $pactoAnticipo;
    }

    function getContituyoFiducia() {
        return $this->contituyoFiducia;
    }

    function setContituyoFiducia($contituyoFiducia) {
        $this->contituyoFiducia = $contituyoFiducia;
    }

    function getSupervisorNit() {
        return $this->supervisorNit;
    }

    function getSupervisorRazonSocial() {
        return $this->supervisorRazonSocial;
    }

    function getTipoSupervisor() {
        return $this->tipoSupervisor;
    }

    function setSupervisorNit($supervisorNit) {
        $this->supervisorNit = $supervisorNit;
    }

    function setSupervisorRazonSocial($supervisorRazonSocial) {
        $this->supervisorRazonSocial = $supervisorRazonSocial;
    }

    function setTipoSupervisor($tipoSupervisor) {
        $this->tipoSupervisor = $tipoSupervisor;
    }

    function getTipoVinculacion() {
        return $this->tipoVinculacion;
    }

    function setTipoVinculacion($tipoVinculacion) {
        $this->tipoVinculacion = $tipoVinculacion;
    }

    function getFaseContratacion() {
        return $this->faseContratacion;
    }

    function setFaseContratacion($faseContratacion) {
        $this->faseContratacion = $faseContratacion;
    }

    function getNumeroCdp() {
        return $this->numeroCdp;
    }

    function getFechaCdp() {
        return $this->fechaCdp;
    }

    function setNumeroCdp($numeroCdp) {
        $this->numeroCdp = $numeroCdp;
    }

    function setFechaCdp($fechaCdp) {
        $this->fechaCdp = $fechaCdp;
    }

    function getEgresos() {
        return $this->egresos;
    }

    function setEgresos($egresos) {
        $this->egresos = $egresos;
    }

    function getVigencia() {
        return $this->vigencia;
    }

    function setVigencia($vigencia) {
        $this->vigencia = $vigencia;
    }

    function getValorCdp() {
        return $this->valorCdp;
    }

    function setValorCdp($valorCdp) {
        $this->valorCdp = $valorCdp;
    }
    function getNumeroCdp2() {
        return $this->numeroCdp2;
    }

    function getFechaCdp2() {
        return $this->fechaCdp2;
    }

    function getValorCdp2() {
        return $this->valorCdp2;
    }

    function setNumeroCdp2($numeroCdp2) {
        $this->numeroCdp2 = $numeroCdp2;
    }

    function setFechaCdp2($fechaCdp2) {
        $this->fechaCdp2 = $fechaCdp2;
    }

    function setValorCdp2($valorCdp2) {
        $this->valorCdp2 = $valorCdp2;
    }
    function getFechaFin() {
        return $this->fechaFin;
    }

    function setFechaFin($fechaFin) {
        $this->fechaFin = $fechaFin;
    }



}
