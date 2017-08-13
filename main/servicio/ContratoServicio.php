<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ContratoServicio
 *
 * @author miuguel
 */
require_once __DIR__ . '/../fabrica/FabricaDAO.php';

class ContratoServicio
{

    private $fabrica;

    public function __construct()
    {
        $this->fabrica = new FabricaDAO(true);
    }

    public function listarContratos()
    {
        $daoContrato = $this->fabrica->construir("ContratoDAO");
        return $resultado = $daoContrato->consultarContratos();
    }

    public function consultar($numero)
    {
        $respuesta = array("existeContrato" => false, "contrato" => null, "existeEgreso" => false, "egresos" => null);
        //generar dao contrato
        $daoContrato = $this->fabrica->construir("ContratoDAO");
        $resultadoContrato = $daoContrato->Consultar($numero);
        if ($resultadoContrato["existe"]) {
            //generar dao egreso
            $daoEgreso = $this->fabrica->construir("EgresoDAO");
            $resultadoEgresos = $daoEgreso->consultar($numero);
            //datos de respuesta
            $respuesta["existeContrato"] = $resultadoContrato["existe"];
            $respuesta["existeEgreso"] = $resultadoEgresos["existe"];
            $respuesta["contrato"] = $resultadoContrato["valor"];
            $respuesta["egresos"] = $resultadoEgresos["valor"];
        }
        return $respuesta;
    }

    public function notificarContratosFinalizacion()
    {
        if (!$_SESSION) {
            session_start();
        }
        if (isset($_SESSION['usuario'])) {
            $dao = $this->fabrica->construir("ContratoDAO");
            $listado = $dao->ConsultarContratosDiasDiferencia(15);
            $_SESSION['notificacion'] = $listado;
            $this->fabrica->close();
        }
    }

    public function registrarContratos($listado)
    {
        $array=[];
        /**
         * @var PersonaDAO $personaDAO
         * @var ContratoDTO $dto
         * @var ContratoDAO $contratoDAO
         * @var PlanGobiernoDAO $planGobiernoDAO
         * @var ModalidadContratoDAO $modalidadDAO
         * @var TipoContratoDAO $tipoContratoDAO
         * @var EgresoDAO $egresoDAO
         */

        $contratoDAO = $this->fabrica->construir("ContratoDAO");
        $tipoContratoDAO = $this->fabrica->construir("TipoContratoDAO");
        $modalidadDAO = $this->fabrica->construir("ModalidadContratoDAO");
        $planGobiernoDAO = $this->fabrica->construir("PlanGobiernoDAO");
        $egresoDAO = $this->fabrica->construir("EgresoDAO");
        $personaDAO = $this->fabrica->construir("PersonaDAO");
        foreach ($listado as $dto) {

            $array[$dto->getIdContrato()]= array("contrato"=>"","egreso"=>[]);
            $modificacion = $dto->getModificacion();

            $estadoContrato = $contratoDAO->estado($dto->getIdContrato());
            // el contrato existe en la bd
            if ($estadoContrato["existe"]) {
                $mod = $estadoContrato["valor"];
                if ($mod == "INFO" and $modificacion = "ORDE") {
                    $array[$dto->getIdContrato()]["contrato"]="exi";
                    $array[$dto->getIdContrato()]["egreso"]=$this->registrarEgresos($dto->getEgresos(), $dto->getIdContrato(), $egresoDAO);
                } elseif ($mod == "ORDE" and $modificacion == "INFO") {
                    $estadoActualizacion=$contratoDAO->actualizar($dto);
                    if($estadoActualizacion){
                        $array[$dto->getIdContrato()]["contrato"]="act";
                    }
                    else{
                        $array[$dto->getIdContrato()]["contrato"]="!act";
                    }
                } elseif (($mod == "COMP" and $modificacion = "ORDE") or ($mod == "ORDE" and $modificacion == "ORDE")) {
                    $array[$dto->getIdContrato()]["contrato"]="exi";
                    $array[$dto->getIdContrato()]["egreso"]=$this->registrarEgresos($dto->getEgresos(), $dto->getIdContrato(), $egresoDAO);
                }
                else{
                    $array[$dto->getIdContrato()]["contrato"]="exi";
                }
            } else {//el contrato no existe en la bd

                $existeTipoContrato = $tipoContratoDAO->existe($dto->getTipoContrato());
                if (!$existeTipoContrato) {
                    $tipoContratoDAO->registrar($dto->getTipoContrato(), "TIPO CONTRATO");
                }
                //existe contratista
                $existeContratista = $personaDAO->existe($dto->getContratistaNit(), $dto->getContratistaRazonSocial());
                if (!$existeContratista) {
                    $personaDAO->registrar($dto->getContratistaNit(), $dto->getContratistaRazonSocial(), $dto->getTipoContratista(), "EXTERNO");
                }

                // informe de contraloria
                if ($modificacion == 'INFO') {
                    $existeSupervisor = $personaDAO->existe($dto->getSupervisorNit(), $dto->getSupervisorRazonSocial());
                    if (!$existeSupervisor) {
                        $personaDAO->registrar($dto->getSupervisorNit(), $dto->getSupervisorRazonSocial(), $dto->getTipoSupervisor(), $dto->getTipoVinculacion());
                    }
                    $existeModalidad = $modalidadDAO->existe($dto->getModalidadContrato());
                    if (!$existeModalidad) {
                        $modalidadDAO->regitrarModalidadContrato($dto->getModalidadContrato(), "DESCRIPCION");
                    }
                    $existePlan = $planGobiernoDAO->existe($dto->getPlanGobierno());
                    if (!$existePlan) {
                        $planGobiernoDAO->registrar($dto->getPlanGobierno(), "PLAN GOBIERNO");
                    }

                }
                $estadoRegistro=$contratoDAO->registrar($dto);
                if($estadoRegistro){
                    $array[$dto->getIdContrato()]["contrato"]="reg";
                    if($modificacion=='ORDE'){
                        $array[$dto->getIdContrato()]["egreso"]=$this->registrarEgresos($dto->getEgresos(),$dto->getIdContrato(),$egresoDAO);
                    }
                }
                else{
                    $array[$dto->getIdContrato()]["contrato"]="!reg";
                }

            }

        }
        $this->fabrica->close();
        return $array;
    }

    /**
     * @param array() $listado
     * @param string $idContrato
     * @param EgresoDAO $dao
     * @return array
     */
    private function registrarEgresos($listado, $idContrato, $dao)
    {
        /**
         * @var  EgresoDTO $egreso
         */
        $array=[];
        if($listado==null)return $array;
        foreach ($listado as $egreso) {
            $existe = $dao->existe($egreso->getEgreso());
            if (!$existe) {
                $egreso->setContrato($idContrato);
                $estado= $dao->registrar($egreso);
                if($estado){
                    $array[$egreso->getEgreso()]="reg";
                }
                else{
                    $array[$egreso->getEgreso()]="!reg";
                }
            }
            else{
                $array[$egreso->getEgreso()]="exi";
            }
        }
        return $array;
    }

    /**
     * @param ContratoDTO $dto
     * @return array();
     */
    public function actualizarContrato($dto)
    {
        $dto = $this->validarDTO($dto);
        $contratoDAO = $this->fabrica->construir("ContratoDAO");
        if ($contratoDAO->actualizar($dto)) {
            return array("estado" => true, "mensaje" => "Actualizacion exitosa");
        }
        $this->fabrica->close();
        return array("estado" => false, "mensaje" => "Actualizacion fallida");
    }

    private function formatoDatepicker($cadena)
    {
        $array = explode("/", $cadena);
        return "$array[2]-$array[0]-$array[1]";
    }

    public function listadoAnexos()
    {
        $resultado = [];
        $tipoDAO = $this->fabrica->construir("TipoContratoDAO");
        $resultado["tipoContrato"] = $tipoDAO->listar();
        $planDAO = $this->fabrica->construir("PlanGobiernoDAO");
        $resultado["planGobierno"] = $planDAO->listar();
        $modalidadDAO = $this->fabrica->construir("ModalidadContratoDAO");
        $resultado["modalidadContrato"] = $modalidadDAO->listar();
        $this->fabrica->close();
        return $resultado;
    }


    public function filtrarContratos($filtros)
    {
        /**
         * @var ContratoDAO $contatoDAO
         */
        $condicion = $this->tratarFiltros($filtros);
        $contatoDAO = $this->fabrica->construir("ContratoDAO");
        return $contatoDAO->filtrarContratos($condicion);
    }

    private function tratarFiltros($array)
    {
        $where = "";
        foreach ($array as $item) {
            if ($item->estado) {
                $inicio = '';
                $fin = '';
                switch ($item->campo) {
                    case 'objeto_contrato':
                        $where .= "and objetoContrato like '%$item->valor%'";
                        break;
                    case 'tipo_contrato':
                        $where .= "and TipoContrato='$item->valor'";
                        break;
                    case 'rubro':
                        $where .= "and rubro='$item->valor'";
                        break;
                    case 'nit_contratista':
                        $where .= "and contratista='$item->valor'";
                        break;
                    case'razon_contratista':
                        $where .= "and contratistaRazonSocial like '%$item->valor%'";
                        break;
                    case 'numero_contrato':
                        $where .= "and idContrato='$item->valor'";
                        break;
                    case 'nit_supevisor':
                        $where .= "and supervisor='$item->valor'";
                        break;
                    case 'razon_supevisor':
                        $where .= "and supervisorRazonSocial like '%$item->valor'%";
                        break;
                    case 'fecha_suscripcion':
                        $inicio = $this->formatoFecha($item->valor[0]);
                        $fin = $this->formatoFecha($item->valor[1]);
                        $where .= "and fechaSuscripcion >= '$inicio' and fechaSuscripcion <= '$fin'";
                        break;
                    case 'valor_contrato':
                        $inicio = $item->valor[0];
                        $fin = $item->valor[1];
                        $where .= "and valor >=$inicio and valor <=$fin";
                        break;
                    case 'valor_anticipo':
                        $where.="and valorAnticipo=$item->valor";
                        break;
                    case 'numero_cdp':
                        $where.="and numeroCdp='$item->valor'";
                        break;
                }
            }
        }
        $cantidad = strlen($where);
        if ($cantidad > 0) {
            $where = 'WHERE ' . substr($where, 4);
        }
        return $where;
    }

    private function formatoFecha($cadena)
    {
        $array = explode("/", $cadena);
        return "$array[2]-$array[0]-$array[1]";
    }

    /**
     * @param ContratoDTO $dto
     * @return mixed
     */
    private function validarDTO($dto)
    {
        $fechaS = $dto->getFechaSuscripcion();
        $fechaI = $dto->getFechaInicio();
        $fechaF = $dto->getFechaFin();
        $fechaC1 = $dto->getFechaCdp();
        $fechaC2 = $dto->getFechaCdp2();
        if ($fechaS == '') {
            $dto->setFechaSuscripcion(null);
        } else {
            $dto->setFechaSuscripcion($this->formatoDatepicker($fechaS));
        }
        if ($fechaI == '') {
            $dto->setFechaInicio(null);
        } else {
            $dto->setFechaInicio($this->formatoDatepicker($fechaI));

        }
        if ($fechaF == '') {
            $dto->setFechaFin(null);
        } else {
            $dto->setFechaFin($this->formatoDatepicker($fechaF));
        }
        if ($fechaC1 == '') {
            $dto->setFechaCdp(null);
        } else {
            $dto->setFechaCdp($this->formatoDatepicker($fechaC1));
        }
        if ($fechaC2 == '') {
            $dto->setFechaCdp2(null);
        } else {
            $dto->setFechaCdp2($this->formatoDatepicker($fechaC2));
        }
        // convertir las cadenas vacias nulas
        $array = [];
        $array[0] = NULL;
        $metodos_clase = get_class_methods($dto);
        foreach ($metodos_clase as $nombre_método) {
            $condicion = substr($nombre_método, 0, 3);
            if ($condicion == 'get') {
                $valor = $dto->$nombre_método();
                if ($valor == '') {
                    $nombre = 'set' . substr($nombre_método, 3, strlen($nombre_método) - 1);
                    call_user_func_array(array($dto, $nombre), $array);
                }
            }
        }
        return $dto;
    }

}
