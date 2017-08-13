<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of FabricaDAO
 *
 * @author miuguel
 */
require_once __DIR__.'/../conexion/Conexion.php';
class FabricaDAO {
    
    private $con;
    /**
     * atributo
     * true (indica si al generar otro dao se utilizara la misma instancia de $con) 
     * false (genera otra instancia de $con al generar un dao)
     * @var boolean 
     */
    private $reutilizar;
    
    public function __construct($reutilizar) {
        $this->con= new Conexion();
        $this->reutilizar=$reutilizar;
    }

        public function construir($nombreDAO){
        require_once __DIR__."/../dao/$nombreDAO.php";
        //$this->generarTransaction();
        $dao= new $nombreDAO($this->con);
        return $dao;     
    }
    
    private  function generarConexion(){
        if(!isset($this->con)){
            $this->con = new Conexion();
            return;
        }
        if(isset($this->con) and !$this->reutilizar){
            $this->con = new Conexion();
        }
    }
    
    public function close(){
        $this->con->close();
    }
    
}
