<?php

if (!isset($_SESSION)) {
    session_start();
}
if (!isset($_SESSION['usuario'])) {
    echo 'Acceso denegado';
    exit();
}
if ($_POST) {
    require_once __DIR__ . '/../main/Fachada.php';
    require_once __DIR__ . '/../main/dto/PersonaDTO.php';
    $dto = new PersonaDTO($_POST["nit"],$_POST["razon"],$_POST["tipo"],$_POST["vinculo"]);
    $respuesta = Fachada::actualizarPersona($dto);
    header('Content-type: application/json; charset=utf-8');
    echo json_encode($respuesta);
    exit();
}