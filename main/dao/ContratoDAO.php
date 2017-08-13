<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Clase Implementa el patron DAO Realiza el CRUD en la tabla 'contrato'
 *
 * @author estudiante
 */
class ContratoDAO
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
     * Metodo para registrar un listado de contratos en la base de datos
     * @param ContratoDTO $item
     * @return boolean
     */
    public function registrar($item)
    {
        $estado = FALSE;
        $query = "INSERT INTO `contrato`(`idContrato`,`fechaSuscripcion`,`valor`,`pagoAnticipo`,`valorAnticipo`," .
            "`fiducia`,`vigencia`,`fechaInicio`,`fechaFin`,`objetoContrato`,`TipoContrato`,`planGobierno`," .
            "`modalidad`,`estadoImportado`,`contratista`,`contratistaRazonSocial`,`supervisor`,`supervisorRazonSocial`,
            `ciudad`,`departamento`,`rubro`,`numeroCdp`,`valorCdp`,`fechaCdp`,`numeroCdp2`,`valorCdp2`,`fechaCdp2`)
            VALUES(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?);";
        $key = 'ssdididssssssssssssssssssss';
        if ($sentencia = $this->con->prepare($query)) {
           $sentencia->bind_param($key, $item->getIdContrato(), $item->getFechaSuscripcion(), $item->getValorContrato(), $item->getPactoAnticipo(), $item->getValorAnticipo(), $item->getContituyoFiducia(), $item->getVigencia(), $item->getFechaInicio(), $item->getFechaCdp(), $item->getObjetoContrato(), $item->getTipoContrato(), $item->getPlanGobierno(), $item->getModalidadContrato(), $item->getModificacion(), $item->getContratistaNit(), $item->getContratistaRazonSocial(), $item->getSupervisorNit(), $item->getSupervisorRazonSocial(), $item->getCiudad(), $item->getDepartamento(), $item->getRubro(), $item->getNumeroCdp(), $item->getValorCdp(), $item->getFechaCdp(), $item->getNumeroCdp2(), $item->getValorCdp2(), $item->getFechaCdp2());
            $estado=$sentencia->execute();
            //printf("Error ContratoDAO registro: %s\n", $sentencia->error);
        }
        if(isset($sentencia)){
            $sentencia->close();
        }
        return $estado;
    }




    /**
     * Metodo para consultar la columna 'estadoImportado' de un registro de la tabla `contrato`
     * @param String $numero
     * @return array()
     */
    public function estado($numero)
    {
        $respuesta = array("existe" => FALSE, "valor" => null);
        $sql = "SELECT `estadoImportado` FROM `contrato` WHERE `idContrato`='$numero' LIMIT 1";
        if($resultado = $this->con->query($sql)){
            if($row =$resultado->fetch_assoc()){
                $respuesta["existe"] = TRUE;
                $respuesta["valor"] = $row["estadoImportado"];
            }
        }
        if(isset($resultado)){
            $resultado->close();
        }

        return $respuesta;
    }

    public function filtrarContratos($filtros)
    {
        $array = [];
        $sql = "SELECT  `idContrato` ,`supervisorRazonSocial`,  `TipoContrato` ,  `contratista` , `contratistaRazonSocial` , IFNULL(  `objetoContrato` ,  'N/A' ) AS  `objetoContrato` , IFNULL(  `rubro` ,  'N/A' ) AS  `rubro` , IFNULL(  `fechaSuscripcion` ,  'N/A' ) AS  `fechaSuscripcion` , IFNULL(  `fechaInicio` ,  'N/A' ) AS  `fechaInicio` ,IFNULL(  `fechaFin` ,  'N/A' ) AS  `fechaFin` , IFNULL(  `valor` , 'N/A' ) AS  `valor` , IFNULL(  `valorAnticipo` ,  'N/A' ) AS  `valorAnticipo` , IFNULL(  `supervisor` ,  'N/A' ) AS  `supervisor` , IFNULL(  `supervisorRazonSocial` ,  'N/A' ) AS `supervisorRazonSocial` , IFNULL(  `numeroCdp` ,  'N/A' ) AS  `numeroCdp` , IFNULL(  `valorCdp` ,  'N/A' ) AS  `valorCdp` , IFNULL(  `fechaCdp` ,  'N/A' ) AS  `fechaCdp` , `estadoImportado` FROM  `contrato` $filtros";
        if ($resultado = $this->con->query($sql)) {
            while ($obj = $resultado->fetch_object()) {
                $array[] = $obj;
            }
        }
        $resultado->close();
        return $array;
    }
    /**
     *
     * @param ContratoDTO $item
     * @return boolean
     */
    public function actualizar($item)
    {
        $estado = false;
        $sql = "UPDATE `contrato` SET `idContrato`=?, `fechaSuscripcion`=?,`valor`=?,`pagoAnticipo`=?,`valorAnticipo`=?," .
            "`fiducia`=?,`vigencia`=?,`fechaInicio`=?,`fechaFin`=?,`objetoContrato`=?,`TipoContrato`=?,`planGobierno`=?," .
            "`modalidad`=?,`estadoImportado`=?,`contratista`=?,`contratistaRazonSocial`=?,`supervisor`=?,`supervisorRazonSocial`=?,
            `ciudad`=?,`departamento`=?,`rubro`=?,`numeroCdp`=?,`valorCdp`=?,`fechaCdp`=?,`numeroCdp2`=?,`valorCdp2`=?,`fechaCdp2`=?
            WHERE `idContrato`=?";
        if ($sentencia = $this->con->prepare($sql)) {
            $key = 'ssdidissssssssssssssssssssss';
            $sentencia->bind_param($key, $item->getIdContrato(), $item->getFechaSuscripcion(),
                $item->getValorContrato(), $item->getPactoAnticipo(), $item->getValorAnticipo(),
                $item->getContituyoFiducia(), $item->getVigencia(), $item->getFechaInicio(), $item->getFechaFin(),
                $item->getObjetoContrato(), $item->getTipoContrato(), $item->getPlanGobierno(),
                $item->getModalidadContrato(), $item->getModificacion(), $item->getContratistaNit(),
                $item->getContratistaRazonSocial(), $item->getSupervisorNit(), $item->getSupervisorRazonSocial(),
                $item->getCiudad(), $item->getDepartamento(), $item->getRubro(), $item->getNumeroCdp(),
                $item->getValorCdp(), $item->getFechaCdp(), $item->getNumeroCdp2(), $item->getValorCdp2(),
                $item->getFechaCdp2(), $item->getIdContrato());
            $estado = $sentencia->execute();
        }
        if(isset($sentencia)){
            $sentencia->close();
        }
        return $estado;


    }

    /**
     * Metodo para listar todos los contratos de la base de datos
     *
     */
    public function consultarContratos()
    {
        $resultado = [];
        $sql = "SELECT `idContrato`,`TipoContrato`,`contratista`,`contratistaRazonSocial`,`objetoContrato`,`rubro`,`fechaSuscripcion`, `fechaInicio`,`fechaFin`,`valor`,`valorAnticipo`,`supervisor`,`supervisorRazonSocial`,`numeroCdp`,`valorCdp`, `fechaCdp` FROM `contrato`";
        $result = $this->con->query($sql);
        if ($result) {
            while ($row = $result->fetch_array(MYSQL_ASSOC)) {
                $resultado[] = $row;
            }
        }
        $result->close();
        $this->con->close();
        return $resultado;
    }

    public function ConsultarContratosDiasDiferencia($diferencia)
    {
        $resultado = [];
        $sql = "SELECT `idContrato`,`TipoContrato`,`fechaSuscripcion`,`fechaInicio`,`fechaFin`, DATEDIFF(fechaFin,CURDATE()) as dias FROM `contrato` where DATEDIFF(fechaFin,CURDATE())<$diferencia and DATEDIFF(fechaFin,CURDATE())>=0";
        $result = $this->con->query($sql);

        if ($result) {
            while ($row = $result->fetch_array(MYSQLI_ASSOC)) {
                $resultado[] = $row;
            }
            $result->close();
        }
        return $resultado;
    }

    public function Consultar($id)
    {
        $respuesta = array("existe" => FALSE, "valor" => null);
        $sql = "SELECT c.`idContrato`, c.`fechaSuscripcion`, c.`valor`, c.`pagoAnticipo`, c.`valorAnticipo`, c.`fiducia`, c.`vigencia`, c.`fechaInicio`, c.`fechaFin`, c.`objetoContrato`, c.`TipoContrato`, c.`planGobierno`, c.`modalidad`, c.`estadoImportado`, c.`contratista` as nitContratista, c.`contratistaRazonSocial` as razonContratista, c.`supervisor` as nitSupervisor, c.`supervisorRazonSocial` as razonSupervisor, c.`ciudad`, c.`departamento`, c.`rubro`, c.`numeroCdp`, c.`valorCdp`, c.`fechaCdp`, c.`numeroCdp2`, c.`valorCdp2`, c.`fechaCdp2` FROM `contrato` c 
WHERE `idContrato`= ?";
        if($sentencia = $this->con->prepare($sql)){
        	$tipos = "s";
            $sentencia->bind_param($tipos, $id);
            if ($sentencia->execute()) {
            	$result = $sentencia->get_result();
            	if ($result) {
            		$respuesta["existe"] = TRUE;
                    $respuesta["valor"] = $result->fetch_object();
                    $result->close();
                }
            }
            $sentencia->close();
        }
        
      
        return $respuesta;
    }

}
