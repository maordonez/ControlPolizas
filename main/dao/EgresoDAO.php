<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of EgresoDAO
 *
 * @author miuguel
 */
class EgresoDAO {

    /**
     *
     * @var Conexion
     */
    private $con;

    /**
     * 
     * @param IConexion $conexion
     */
    public function __construct($conexion) {
        $this->con = $conexion;
    }

    public function consultar($contrato) {
        $respuesta = array("existe" => FALSE, "valor" => null);
        $sql = "SELECT `egreso`, `valorCf`, `fechaMov` FROM `egreso` WHERE `idContrato`=?";
        if($sentencia = $this->con->prepare($sql)){
            $tipos = "s";
            $sentencia->bind_param($tipos, $contrato);
            if ($sentencia->execute()) {
                $result = $sentencia->get_result();
                if ($result) {
                    $egresos = [];
                    while ($row = $result->fetch_object()) {
                        $egresos[] = $row;
                    }
                    $respuesta["existe"] = TRUE;
                    $respuesta["valor"] = $egresos;
                    $result->close();
                }
            }
            $sentencia->close();
        }

        return $respuesta;
    }

    public function buscar($id) {
        $dto = null;
        $sql = "SELECT `egreso`, `valorCf`, `fechaMov`, `idContrato` FROM `egreso` WHERE `egreso`=?";
        $sentencia = $this->con->prepare($sql);
        if ($sentencia) {
            $tipos = "s";
            $sentencia->bind_param($tipos, $id);
            if ($sentencia->execute()) {
                $resultado = $sentencia->get_result();
                if ($fila = $resultado->fetch_assoc()) {
                    $dto = new EgresoDTO($fila["egreso"], $fila["fechaMov"], $fila["valorCf"]);
                    $dto->setContrato($fila["idContrato"]);
                    $resultado->close();
                }
                $sentencia->close();
            }
        }
        return $dto;
    }

    public function existe($id){
        $estado=false;
        $sql="SELECT true FROM `egreso` WHERE `egreso`='$id' LIMIT 1";
        if($resultado=$this->con->query($sql)){
            $row =$resultado->num_rows;
            $estado= $row>0;
            $resultado->close();
        }
        return $estado;
    }

    /**
     * 
     * @param EgresoDTO $egreso
     * @return boolean comprueba el exito de la transaccion
     */
    public function actualizar($egreso) {
        $estado = FALSE;
        $sql = "UPDATE `egreso` SET `egreso`=?,`valorCf`=?,`fechaMov`=? WHERE `egreso`=?";
        $sentencia = $this->con->prepare($sql);
        if ($sentencia) {
            $tipos = "ssss";
            $sentencia->bind_param($tipos, $egreso->getEgreso(), $egreso->getValor(), $egreso->getFechaMov(), $egreso->getEgreso());
            $estado = $sentencia->execute();
            $sentencia->close();
        }
        return $estado;
    }

    public function eliminar($id) {
        $estado = FALSE;
        $sql = "DELETE FROM `egreso` WHERE `egreso`=?";
        $sentencia = $this->con->prepare($sql);
        if ($sentencia) {
            $tipos = "s";
            $sentencia->bind_param($tipos, $id);
            $estado = $sentencia->execute();
            $sentencia->close();
        }
        return $estado;
    }

    /**
     * 
     * @param EgresoDTO $egreso
     * @return array()
     */
    public function registrar($egreso) {
        $estado = FALSE;
        $sql = "INSERT INTO `egreso`(`egreso`, `valorCf`, `fechaMov`, `idContrato`) VALUES (?,?,?,?)";
        $sentencia = $this->con->prepare($sql);
        if ($sentencia) {
            $tipos = "ssss";
            $sentencia->bind_param($tipos, $egreso->getEgreso(), $egreso->getValor(), $egreso->getFechaMov(), $egreso->getContrato());
            $estado = $sentencia->execute();
            $sentencia->close();
        }
        return $estado;
    }

}
