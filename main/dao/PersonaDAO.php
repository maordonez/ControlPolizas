<?php

/**
 * Created by PhpStorm.
 * User: miuguel
 * Date: 04/06/2017
 * Time: 04:29 PM
 */
class PersonaDAO
{
    /**
     * @var mysqli $con
     */
    private $con;

    /**
     * PersonaDAO constructor.
     * @param mysqli $conexion
     */
    public function __construct($conexion)
    {
        $this->con = $conexion;
    }

    /**
     * @param string $nit
     * @param string $razon
     * @param string $tipo
     * @param string $vinculo
     * @return boolean
     */
    public function registrar($nit, $razon, $tipo, $vinculo)
    {
        $estado=false;
        $sql = "INSERT INTO `persona`(`nit`, `razon`, `tipoPersona`, `vinculo`) VALUES (?,?,?,?);";
        if ($sentencia = $this->con->prepare($sql)) {
            $tipos = 'ssss';
            $sentencia->bind_param($tipos, $nit, $razon, $tipo, $vinculo);
            $estado=$sentencia->execute();
            $sentencia->close();
        }
        return $estado;
    }

    /**
     * @param PersonaDTO $dto
     * @return bool
     */
    public function actualizar($dto)
    {
        $estado=false;
        $sql = "UPDATE `persona` SET `tipoPersona`= ? , `vinculo`=? WHERE `nit`=? and `razon`= ?";
        if ($sentencia = $this->con->prepare($sql)) {
            $tipos = 'ssss';
            $sentencia->bind_param($tipos, $dto->getTipoPersona(), $dto->getVinculo(), $dto->getNit(), $dto->getRazonSocial());
            $estado=$sentencia->execute();

            $sentencia->close();
        }
        return $estado;
    }

    /**
     * @param string $nit
     * @param string $razon
     * @return bool
     */
    public function existe($nit, $razon)
    {
        $estado = false;
        $sql = "select true from persona where nit='$nit' and razon='$razon' LIMIT 1";
        $resultado = $this->con->query($sql);
        if ($resultado) {
            $row = $resultado->num_rows;
            $estado = $row > 0;
            $resultado->close();
        }
        return $estado;
    }

    public function listar(){
        $resultado=[];
        $sql="SELECT `nit`, `razon`, `tipoPersona`, `vinculo` FROM `persona`";
        $result = $this->con->query($sql);
        if ($result) {
            while ($row = $result->fetch_array(MYSQLI_ASSOC)) {
                $resultado[] = $row;
            }
            $result->close();
        }
        return $resultado;
    }
    public function buscar($nit,$razon){
        $retorno= false;
        $sql = "select * from persona where nit='$nit' and razon='$razon' LIMIT 1";
        $resultado = $this->con->query($sql);
        if ($resultado) {
            $retorno = $resultado->fetch_array(MYSQLI_ASSOC);
            $resultado->close();
        }
        return $retorno;
    }

}