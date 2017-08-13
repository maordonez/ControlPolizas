<?php

/**
 * Created by PhpStorm.
 * User: miuguel
 * Date: 28/05/2017
 * Time: 09:00 PM
 */
class ModalidadContratoDAO
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
     * Metodo lista todas las modalidades de un contrato en la BD
     * @return array()
     */
    public function listar()
    {
        $array = [];
        $sql = "SELECT `modalidad` FROM `modalidadcontrato`";
        if ($resultado = $this->con->query($sql)) {
            while ($objeto = $resultado->fetch_object()) {
                $array[] = $objeto->modalidad;
            }
            $resultado->close();
        }

        return $array;

    }

    /**
     * Metodo para registrar la modalidad de un contrato
     * @param String $modalidad
     * @param String $descripcion
     */
    public function regitrarModalidadContrato($modalidad, $descripcion)
    {
        $sql = "INSERT INTO `modalidadcontrato`(`modalidad`, `descipcion`) VALUES (?,?);";
        if ($sentencia = $this->con->prepare($sql)) {
            $tipos = 'ss';
            $sentencia->bind_param($tipos, $modalidad, $descripcion);
            $sentencia->execute();
            $sentencia->close();
        }
    }

    public function existe($modalidad)
    {
        $estado = false;
        $sql = "SELECT true FROM `modalidadcontrato` WHERE `modalidad`='$modalidad' LIMIT 1";
        $resultado = $this->con->query($sql);
        if ($resultado) {
            $row = $resultado->num_rows;
            $estado = $row > 0;
            $resultado->close();
        }
        return $estado;
    }

}