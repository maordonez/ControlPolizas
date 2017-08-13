<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of UsuarioServicio
 *
 * @author miuguel
 */
require_once __DIR__ . '/../fabrica/FabricaDAO.php';

class UsuarioServicio {

    public static function identificarUsuario($id, $clave) {
        $resultado = array('estado' => false, 'mensaje' => 'Id o contraseña incorrecta');
        $fabrica = new FabricaDAO(true);
        $dao = $fabrica->construir('UsuarioDAO');
        $dto = $dao->consultar($id);

        if ($dto != null) {
            $usuario = $dto->getUsuario();
            $contra = $dto->getContra();
            if ($usuario == $id && $contra == $clave) {
                self::crearSesion($dto);
                $resultado['estado'] = true;
                $resultado['mensaje'] = 'Inicio de Session';
            }
        }
        return $resultado;
    }
    /**
     * 
     * @param UsuarioDTO $usuario
     */
    private static function crearSesion($usuario){
        session_start();
        $_SESSION['usuario']= array('id'=>$usuario->getUsuario(),
            'nombres'=>$usuario->getNombres(),
            'apellidos'=>$usuario->getApellidos());
    }
    

}
