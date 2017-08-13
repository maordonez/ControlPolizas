<?php

session_start();
if (isset($_SESSION['usuario'])) {
    if ($_POST) {
        require_once __DIR__ . '/../main/Fachada.php';

        $json = $_POST['data'];
        $array = json_decode($json);
        $respuesta = Fachada::registrarImporte($array);
        header('Content-type: application/json; charset=utf-8');
        echo json_encode($respuesta);
        exit();
    }
}

