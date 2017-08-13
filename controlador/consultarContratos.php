<?php
session_start();
if (isset($_SESSION['usuario'])) {
   if ($_POST) {
        require_once __DIR__ . '/../main/Fachada.php';
        $filtros =json_decode($_POST["filtros"]);
        $_SESSION["filtros"]=$_POST["filtros"];
        $array =Fachada::listarContratos($filtros);
        header('Content-type: application/json; charset=utf-8');
        echo json_encode($array);
        exit();
    }
}


