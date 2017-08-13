<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Calculador
 *
 * @author miuguel
 */
/*
class Calculador {

    private $dic;
    private $cadena;
    private $inicia;
    private $inicia2;

    public function __construct($cad) {
        $this->cadena = $cad;
        $this->inicia = ['PLANEACION DEL', 'EJECUCION', 'DURANTE EL MES DE', 'DURANTE'];
        $this->dic = parse_ini_file(__DIR__ . '/../config/dic.ini');
    }

    public function convertir() {
        $key = $this->buscarInicio();
        $this->clasificarCadena($key);
    }

    private function clasificarCadena($key) {
        $array = explode(' ', $key['value']);
        $val = $key['opcion'];
        if ($val == 'PLANEACION DEL' || $val == 'DURANTE EL MES DE') {
            $result = $this->buscarRangos($array);
            echo '(  ' . $result['DE'] . ' -' . $result['HASTA'] . ') mes :' . $result['MES'].' año :'.$result['AÑO'];
        } else {

            echo $this->buscarCardinal($array);
        }
    }

    private function buscarRangos($array) {
        $conector = null;
        $result = array('DE' => 0, 'HASTA' => 0, 'MES' => 0, 'AÑO' => 0);
        foreach ($array as $item) {
            if (is_numeric($item)) {
                $result['DE'] = ($conector == null) ? $item : $result['DE'];
                $result['HASTA'] = ($conector == null) ? $result['HASTA'] : $item;
            } elseif ($item == 'AL') {
                $conector = $item;
            } else {
                if (strpos($item, '-') !== FALSE) {
                    $val = explode('-', $item);
                    $item = $val[0];
                    $result['AÑO'] = $val[1];
                }

                switch ($item) {
                    case 'ENERO': $result['MES'] = 01;
                        break;
                    case 'FEBRERO': $result['MES'] = 02;
                        break;
                    case 'MARZO': $result['MES'] = 03;
                        break;
                    case 'ABRIL': $result['MES'] = 04;
                        break;
                    case 'MAYO': $result['MES'] = 05;
                        break;
                    case 'JUNIO': $result['MES'] = 06;
                        break;
                    case 'JULIO': $result['MES'] = 07;
                        break;
                    case 'AGOSTO': $result['MES'] = 08;
                        break;
                    case 'SEPTIEMBRE': $result['MES'] = 09;
                        break;
                    case 'OCTUBRE': $result['MES'] = 10;
                        break;
                    case 'NOVIEMBRE': $result['MES'] = 11;
                        break;
                    case 'DICIEMBRE': $result['MES'] = 12;
                        break;

                    default :
                        if (strlen($item) == 4) {
                            
                        }
                        break;
                }
            }
        }
        return $result;
    }

    private function buscarCardinal($array) {
        $valor1 = 0;
        $mult = $this->dic['keyMultiplo'];
        $uni = $this->dic['keyUnitario'];
        $key = $this->dic['key'];
        foreach ($array as $item) {

            if (isset($mult[$item])) {
                $valor1 = $mult[$item];
            } elseif (isset($uni[$item])) {
                $valor1 += $uni[$item];
            } elseif (isset($key[$item])) {
                $valor1 = $key[$item];
            } else {
                $val = strpos($item, 'VENTI');
                if ($val !== false) {
                    $valor1 = 20;
                    $vec = explode('VENTI', $item);

                    $valor1 .= $uni[$vec[1]];
                    break;
                }
            }
        }
        return $valor1;
    }

    private function buscarInicio() {
        $subCadena = null;
        $opcion = null;
        foreach ($this->inicia as $lim) {
            $val = strpos($this->cadena, $lim);
            if ($val !== false) {
                $num = strlen($lim);
                $subCadena = substr($this->cadena, ($val + $num + 1));
                $opcion = $lim;
                break;
            }
        }
        return array('opcion' => $opcion, 'value' => $subCadena);
    }

}
*/