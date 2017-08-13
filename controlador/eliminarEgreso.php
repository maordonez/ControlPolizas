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
    require_once __DIR__ . '/../main/dto/EgresoDTO.php';
    $idEgreso =$_POST["egreso"];
    $respuesta = Fachada::eliminarEgreso($idEgreso);
    header('Content-type: application/json; charset=utf-8');
    echo json_encode($respuesta);
    exit();
}

