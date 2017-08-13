<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of fachada
 *
 * @author miuguel
 */
class Fachada {

    public static function listarPersonas(){
        require_once  __DIR__.'/servicio/PersonaServicio.php';
        $servicio = new PersonaServicio();
        return $servicio->listar();
    }
    public static function registrarPersona($dto){
        require_once __DIR__.'/servicio/PersonaServicio.php';
        $servicio =new PersonaServicio();
        return $servicio->registro($dto);

    }
    public static function actualizarPersona($dto){
        require_once __DIR__.'/servicio/PersonaServicio.php';
        $servicio =new PersonaServicio();
        return $servicio->actualizar($dto);
    }
    public static function buscarPersona($nit,$razon){
        require_once __DIR__.'/servicio/PersonaServicio.php';
        $servicio =new PersonaServicio();
        return  $servicio->busqueda($nit,$razon);

    }

    //************************************************USUARIO*********************************+
    public static function iniciarSession($id, $clave) {
        require_once __DIR__ . '/servicio/UsuarioServicio.php';
        $servicio = new UsuarioServicio($id, $clave);
        return $servicio->identificarUsuario($id, $clave);
    }

    public static function cerrarSesion() {
        session_start();
        session_destroy();
    }
   //*************************************************IMPORTE **************************************
    public static function registrarImporte($array) {
        require_once __DIR__ . '/servicio/ImporteServicio.php';
        require_once __DIR__.'/servicio/ContratoServicio.php';
        $importe = new ImporteServicio($array);
        $contratos = new ContratoServicio();
        $respuesta = $contratos->registrarContratos($importe->getContratos());

        return $respuesta;
    }
   //************************************************CONTRATOS***************************************
    public static function listarContratos($filtros) {
        require_once __DIR__ . '/servicio/ContratoServicio.php';
        $contrato = new ContratoServicio();
        return $contrato->filtrarContratos($filtros);
    }

    public static function notificacion() {
        require_once __DIR__ . '/servicio/ContratoServicio.php';
        $contrato = new ContratoServicio();
        $contrato->notificarContratosFinalizacion();
    }

    public static function consultarContrato($numero) {
        require_once __DIR__ . '/servicio/ContratoServicio.php';
        $contrato = new ContratoServicio();
        return $contrato->consultar($numero);
    }

    /**
     * @param ContratoDTO $dto
     * @return array()
     */
    public static function actualizarContrato($dto){
        require_once __DIR__.'/servicio/ContratoServicio.php';
        $contrato= new ContratoServicio();
        return $contrato->actualizarContrato($dto);
    }


    public static function listarAnexos(){
        require_once __DIR__ . '/servicio/ContratoServicio.php';
        $contrato = new ContratoServicio();
        return $contrato->listadoAnexos();
    }

    public static function exportar($filtros){
        require_once __DIR__.'/servicio/ExcelReporte.php';
        require_once __DIR__.'/servicio/ContratoServicio.php';
        $contrato = new ContratoServicio();
        $array =$contrato->filtrarContratos($filtros);
        $excel = new ExcelReporte($array);
        $excel->generarReporte2();

    }
    //*****************************************EGRESOS*********************************************
    public static function registrarEgreso($dto){
        require_once __DIR__ . '/servicio/EgresoServicio.php';
        $egreso = new EgresoServicio;
        return $egreso->registrarEgreso($dto);
    }
    public static function actualizarEgreso($dto){
        require_once __DIR__ . '/servicio/EgresoServicio.php';
        $egreso = new EgresoServicio();
        return $egreso->actualizarEgresos($dto);
    }
    public static function eliminarEgreso($id){
        require_once __DIR__ . '/servicio/EgresoServicio.php';
        $egreso= new EgresoServicio();
        return $egreso->eliminarEgreso($id);
    }
    
    

}
