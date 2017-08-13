<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Conexion
 *
 * @author miuguel
 */
//require_once __DIR__.'/EMysqli.php';
class Conexion extends mysqli {

    public function __construct() {
        //parent::__construct('sandbox2.ufps.edu.co', 'ufps_64', 'ufps_pp', 'ufps_64', 3306);
        parent::__construct('127.0.0.1', '1151178', '1871', 'control_polizas', 3306);
        if (mysqli_connect_errno()) {
            printf("Falló la conexión: %s\n", mysqli_connect_error());
            exit();
        }
    }
}
