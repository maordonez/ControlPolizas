<?php
//require_once __DIR__.'/../main/servicio/Calculador.php';
//
//$analizador = new Calculador('SERVICIOS PROFESIONALES REALIZACION DE ACTIVIDADES EN OBRAS CIVILES PARA LOS DIFERENTES PROYECTOS ADELANTADOS POR LA OFICINA DE PLANEACION DEL 2 AL 16 DE ENERO-2017');
//$analizador->convertir();
require_once __DIR__.'/../main/Fachada.php';
Fachada::notificacion();
//$numeroContrato =$_GET['id'];
//$data =Fachada::consultarContrato($numeroContrato);
print_r($data);