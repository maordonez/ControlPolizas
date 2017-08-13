<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of UsuarioDAO
 *
 * @author miuguel
 */
class UsuarioDAO {

    /**
     *
     * @var mysqli
     */
    private $con;

    /**
     * 
     * @param IConexion $conexion
     */
    public function __construct($conexion) {
        $this->con = $conexion;
    }

    /**
     * realiza un select en la tabla Usuario filtrado por el atributo ID
     * @param String id
     * @return UsuarioDTO $dto
     */
    public function consultar($id) {
        require_once __DIR__.'/../dto/UsuarioDTO.php';
        $dto = null;
        $sentencia = $this->con->prepare('SELECT id,clave,nombres,apellidos FROM  usuario WHERE id=? ');
        if($sentencia){
             $tipo="s";
        if ($sentencia->bind_param($tipo, $id)) {
            if ($sentencia->execute()) {
                $resultado = $sentencia->get_result();
                if($row= $resultado->fetch_row()){
                    $dto = new UsuarioDTO();
                    $dto->setContra($row[1]);
                    $dto->setUsuario($row[0]);
                    $dto->setNombres($row[2]);
                    $dto->setApellidos($row[3]);
                }
                
            }
            $sentencia->close();
        }

        }
       
        return $dto;
    }

}
