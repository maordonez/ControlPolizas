<?php

if (!isset($_SESSION)) {
    session_start();
}
if (!isset($_SESSION['usuario'])) {
    echo 'Acceso denegado';
    exit();
}
if ($_POST) {
    require_once __DIR__.'/../main/dto/ContratoDTO.php';
    require_once __DIR__.'/../main/Fachada.php';
    $fiducia =0;
    $pactoAnticipo=0;
    if(isset($_POST["contituyoFiducia"])){
        $fiducia=1;
    }
    if(isset($_POST["pactoAnticipo"])){
        $pactoAnticipo=1;
    }
    $contratoDTO =new ContratoDTO();
    $contratoDTO->setIdContrato($_POST["idContrato"]);
    $contratoDTO->setFechaSuscripcion($_POST["fechaSuscripcion"]);
    $contratoDTO->setFechaInicio($_POST["fechaInicio"]);
    $contratoDTO->setFechaFin($_POST["fechaFin"]);
    $contratoDTO->setObjetoContrato($_POST["objetoContrato"]);
    $contratoDTO->setValorContrato($_POST["valorContrato"]);
    $contratoDTO->setValorAnticipo($_POST["valorAnticipo"]);
    $contratoDTO->setPactoAnticipo($pactoAnticipo);
    $contratoDTO->setContituyoFiducia($fiducia);
    $contratoDTO->setRubro($_POST["rubro"]);
    $contratoDTO->setNumeroCdp($_POST["numeroCompromiso"]);
    $contratoDTO->setFechaCdp($_POST["fechaCompromiso"]);
    $contratoDTO->setValorCdp($_POST["valorCompromiso"]);
    $contratoDTO->setNumeroCdp2($_POST["numeroCompromiso2"]);
    $contratoDTO->setFechaCdp2($_POST["fechaCompromiso2"]);
    $contratoDTO->setValorCdp2($_POST["valorCompromiso2"]);
    $contratoDTO->setCiudad($_POST["ciudad"]);
    $contratoDTO->setDepartamento($_POST["departamento"]);
    $contratoDTO->setModificacion("COMP");
    //contratista
    $contratoDTO->setContratistaNit($_POST["nitContratista"]);
    $contratoDTO->setContratistaRazonSocial($_POST["razonSocialContratista"]);
    
    //supervisor
    $contratoDTO->setSupervisorNit($_POST["nitSupervisor"]);
    $contratoDTO->setSupervisorRazonSocial($_POST["razonSocialSupervisor"]);
    
    //anexos
    $contratoDTO->setTipoContrato($_POST["tipoContrato"]);
    $contratoDTO->setPlanGobierno($_POST["planGobierno"]);
    $contratoDTO->setModalidadContrato($_POST["modalidad"]);
    $respuesta =Fachada::actualizarContrato($contratoDTO);
    Fachada::notificacion();
    header('Content-type: application/json; charset=utf-8');
    echo json_encode($respuesta);
    exit;


}
