<?php

/**
 * Created by PhpStorm.
 * User: miuguel
 * Date: 28/05/2017
 * Time: 09:03 PM
 */
class PlanGobiernoDAO
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
     * Metodo lista todas los planes de gobiernos en la BD
     * @return array()
     */
    public function listar()
    {
        $array = [];
        $sql = "SELECT `codigo` FROM `plangobierno`";
        if ($resultado = $this->con->query($sql)) {
            while ($objeto = $resultado->fetch_object()) {
                $array[] = $objeto->codigo;
            }
        }
        $resultado->close();
        return $array;

    }

    /**
     * Metodo para registrar el plan de gobierno de un contrato
     * @param String $plan
     * @param String $descripcion
     * @return bool
     */
    public function registrar($plan, $descripcion)
    {
        $estado=false;
        $sql="INSERT INTO `plangobierno`(`codigo`, `descripcion`) VALUES (?,?)";
        if($sentencia = $this->con->prepare($sql)){
            $tipos = 'ss';
            $sentencia->bind_param($tipos, $plan, $descripcion);
            $estado=$sentencia->execute();
            $sentencia->close();
        }

        return $estado;
    }

    /**
     * @param string $plan
     * @return bool
     */
    public function existe($plan)
    {
        $estado = false;
        $sql = "SELECT `codigo`, `descripcion` FROM `plangobierno` WHERE `codigo`='$plan' LIMIT 1";
        $resultado = $this->con->query($sql);
        if ($resultado) {
            $row = $resultado->num_rows;
            $estado = $row > 0;
            $resultado->close();
        }
        return $estado;
    }

}