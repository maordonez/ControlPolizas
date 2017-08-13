<?php
if (!isset($_SESSION)) {
    session_start();
}
if (!isset($_SESSION['usuario'])) {
    echo 'Acceso denegado';
    exit();
}
if (isset($_SESSION["filtros"])) {
    require_once __DIR__ . '/../main/Fachada.php';
    $filtros = json_decode($_SESSION["filtros"]);
    Fachada::exportar($filtros);
    exit;
}

