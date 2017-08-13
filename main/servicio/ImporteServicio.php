<?php

require_once __DIR__ . '/../dto/ContratoDTO.php';
require_once __DIR__ . '/../dto/EgresoDTO.php';
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ImporteServicio
 *
 * @author miuguel
 */
class ImporteServicio {

    private $data;
    //listado de comprobantes de pago
    private $listadoA;
    //listado de informe de contraloria
    private $listadoB;
    //listado completo
    private $listadoD;

    public function __construct($list) {
        $this->data = $list;
        $this->listadoA = [];
        $this->listadoB = [];
        $this->listadoD = [];
        $this->procesar();
    }

    private function procesar() {
        foreach ($this->data as $item) {
            $tipoDocumento = $item->tipo;
            $array = $item->data;
            if ($tipoDocumento == "Orden de comprobante de pago") {
                $this->procesarOrdenComprobantePago($item->data);
            } else {
                $this->procesarInformeContraloria($item->data);
            }
        }
    }

    public function getContratos() {
        $resultado = [];
        $resultado = array_merge($this->listadoA, $this->listadoB);
        $resultado = array_merge($resultado, $this->listadoD);
        return $resultado;
    }

    private function procesarOrdenComprobantePago($array) {
        foreach ($array as $obj) {

            /**
             * @var ContratoDTO
             */
            //consulto si existe el contrato en el array listadoB(informe de contraloria)
            $dto = null;
            if (isset($this->listadoB[$obj->CONSECUTIVO])) {
                $dto = $this->listadoB[$obj->CONSECUTIVO];
            } else {
                $dto = new ContratoDTO();
                $dto->setIdContrato($obj->CONSECUTIVO);
                $dto->setTipoContrato($obj->FUENTE);
                $dto->setContratistaNit(str_replace("-", "", $obj->NIT));
                $dto->setContratistaRazonSocial($obj->PORCONCEPTO);
                $dto->setFechaInicio($obj->FECHAMOV);
                $dto->setModificacion('ORDE');
                unset($this->listadoB[$obj->CONSECUTIVO]);
            }

            $items = $obj->egresos;
            $listadoEgreso = [];
            foreach ($items as $item) {
                $fecha = $this->formatoFecha($item->CF_FECHA);
                $listadoEgreso[$item->EGRESO] = new EgresoDTO($item->EGRESO, $fecha, $item->CF_VALOR);
            }
            $dto->setEgresos($listadoEgreso);
            $modificado = $dto->getModificacion();

            $id = $dto->getIdContrato();
            if ($modificado == 'INFO') {
                $dto->setModificacion('COMP');
                $this->listadoD[$id] = $dto;
                unset($this->listadoB[$id]);
            } else {
                $this->listadoA[$id] = $dto;
            }
        }
    }

    private function procesarInformeContraloria($array) {
        foreach ($array as $obj) {
            $dto = null;
            if (isset($this->listadoA[$obj->{'NÚMERO DE CONTRATO'}])) {
                $dto = $this->listadoA[$obj->{'NÚMERO DE CONTRATO'}];
            } else {
                $dto = new ContratoDTO();
                $dto->setIdContrato($obj->{'NÚMERO DE CONTRATO'});
                $dto->setTipoContrato($obj->{'TIPO DE CONTRATO'});
                $fechaSup = $this->formatoFecha($obj->{'FECHA SUSCRIPCIÓN'});
                $dto->setFechaSuscripcion($fechaSup);
                $dto->setModificacion('INFO');
            }
            //contrato   
            $dto->setRubro($obj->RUBRO);
            $dto->setObjetoContrato($obj->{'OBJETO DEL CONTRATO'});
            $dto->setValorContrato($obj->{'VALOR DEL CONTRATO'});
            $dto->setPactoAnticipo($obj->{'PACTO ANTICIPO'});
            $dto->setValorAnticipo($obj->{'VALOR ANTICIPO'});
            $dto->setContituyoFiducia($obj->{'CONSTITUYÓ FIDUCIA'});
            $dto->setDepartamento($obj->DEPARTAMENTO);
            $dto->setCiudad($obj->{'CIUDAD O MCIPIO'});
            //foraneas
            $dto->setModalidadContrato($obj->{'MODALIDAD DE CONTRATACIÓN'});
            $dto->setPlanGobierno($obj->{'PLAN GOBIERNO'});
            //contratista
            $dto->setContratistaNit($obj->CONTRATISTA);
            $dto->setContratistaRazonSocial($obj->{'NOMBRE O RAZÓN SOCIAL'});
            $dto->setTipoContratista($obj->{'TIPO PERSONA(N O J)'});
            //supervisor
            $supervisor = $this->formatoSupervisor($obj->{'NOMBRE O RAZÓN SOCIAL_1'});
            $dto->setSupervisorRazonSocial($supervisor[0]);
            $dto->setSupervisorNit($supervisor[1]);
            $dto->setTipoSupervisor($obj->{'TIPO PERSONA'});
            $dto->setTipoVinculacion($obj->{'TIPO VINCULACIÓN'});
            //compromiso 1
            $fechaCdp1 = $this->formatoFechaCompromiso($obj->{'FECHA DE CDP'});
            $dto->setEtapa($obj->{'ETAPA DE CONTRATACIÓN'});
            $dto->setFaseContratacion($obj->{'FASE DE CONTRATACIÓN'});
            $dto->setNumeroCdp($obj->{'NÚMERO DE CDP'});
            $dto->setFechaCdp($fechaCdp1);
            $dto->setValorCdp($obj->{'VALOR CDP'});
            //compromiso 2
            $fechaCdp2 = $this->formatoFechaCompromiso($obj->{'FECHA DE COMPROMISO'});
            $dto->setNumeroCdp2($obj->{'NÚMERO DE COMPROMISO'});
            $dto->setFechaCdp2($fechaCdp2);
            $dto->setValorCdp2($obj->{'VALOR COM'});
            //estado modificacion contrato
            $modificado = $dto->getModificacion();

            $id = $dto->getIdContrato();
            if ($modificado == 'ORDE') {
                $dto->setModificacion('COMP');
                $this->listadoD[$id] = $dto;
                unset($this->listadoA[$id]);
            } else {
                $this->listadoB[$id] = $dto;
            }
        }
    }

    public function display() {
        echo '*******************LISTA A********************************<br>';
        print_r($this->listadoA);
        echo '<br>*******************LISTA B********************************<br>';
        print_r($this->listadoB);
        echo '<br>*******************LISTA D********************************<br>';
        print_r($this->listadoD);
    }

    private function formatoSupervisor($cadena) {
        $array = explode(" C C ", $cadena);
        return $array;
    }

    private function formatoFechaCompromiso($cadena) {
        $array = explode('/', $cadena);
        $fecha = "20$array[2]-$array[0]-$array[1]";
        return $fecha;
    }

    private function formatoFecha($cadena) {
        $array = explode("-", $cadena);
        $mes = strtoupper($array[1]);
        switch ($mes) {
            case 'ENE':
            case 'JAN':
                $mes = '01';
                break;
            case 'FEB':
                $mes = '02';
                break;
            case 'MAR':
                $mes = '03';
                break;
            case 'ABR':
                $mes = '04';
                break;
            case 'MAY':
                $mes = '05';
                break;
            case 'JUN':
                $mes = '06';
                break;
            case 'JUL':
                $mes = '07';
                break;
            case 'AGO':
                $mes = '08';
                break;
            case 'SEP':
                $mes = '09';
                break;
            case 'OCT':
                $mes = '10';
                break;
            case 'NOV':
                $mes = '11';
                break;
            case 'DEC':
                $mes = '12';
                break;
        }
        $fecha = "20$array[2]-$mes-$array[0]";
        return $fecha;
    }

    

}
