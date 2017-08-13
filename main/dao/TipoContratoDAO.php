<?php

/**
 * Created by PhpStorm.
 * User: miuguel
 * Date: 28/05/2017
 * Time: 08:44 PM
 */
class TipoContratoDAO
{
    /**
     *
     * @var Conexion
     */
    private $con;

    /**
     *
     * @param IConexion $conexion
     */
    public function __construct($conexion)
    {
        $this->con = $conexion;
    }

    /**
     * Metodo lista todos los tipos de contratos de la BD
     * @return array()
     */
    public function listar()
    {
        $array = [];
        $sql = "SELECT codigo FROM `tipocontrato` ";
        if ($resultado = $this->con->query($sql)) {
            while ($objeto = $resultado->fetch_object()) {
                $array[] = $objeto->codigo;
            }
            $resultado->close();
        }

        return $array;

    }

    /**
     * Metodo para registrar un tipo de contrato
     * @param String $tipo
     * @param String $descripcion
     * @return bool
     */
    public function registrar($tipo, $descripcion)
    {
        $estado =false;
        $sql ="INSERT INTO `tipocontrato`(`codigo`, `descripcion`) VALUES (?,?);";
        if($sentencia = $this->con->prepare($sql)){
            $type = "ss";
            $sentencia->bind_param($type, $tipo, $descripcion);
            $estado=$sentencia->execute();
            $sentencia->close();
        }
        return $estado;
    }

function existe($tipo)
{
    $estado = false;
    $sql = "SELECT true FROM `tipocontrato` WHERE `codigo`='$tipo' LIMIT 1";
    $resultado = $this->con->query($sql);
    if ($resultado) {
        $row = $resultado->num_rows;
        $estado = $row > 0;
        $resultado->close();
    }
    return $estado;
}
}