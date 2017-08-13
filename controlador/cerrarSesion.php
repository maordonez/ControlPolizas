<?php
    require_once __DIR__.'/../main/Fachada.php';
    Fachada::cerrarSesion();
    header('Location:/ControlPolizas/index.php');

