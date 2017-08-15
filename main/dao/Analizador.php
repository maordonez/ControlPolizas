<?php

/**
 * Created by PhpStorm.
 * User: miuguel
 * Date: 06/07/2017
 * Time: 08:16 PM
 */
class Analizador
{


    private $contador;
    private $year = "2017";

    /**
     * @param $cadena
     * @return int
     */

    private function analizarMes($cadena)
    {
        $abvMes = substr($cadena, 0, 3);
        $mes = -1;
        switch ($abvMes) {
            case 'ENE':
                $mes = 1;
                break;
            case 'FEB':
            case 'FBR':
                $mes = 2;
                break;
            case 'MAR':
            case 'MRZ':
                $mes = 3;
                break;
            case 'ABR':
                $mes = 4;
                break;
            case 'MAY':
                $mes = 5;
                break;
            case 'JUN':
                $mes = 6;
                break;
            case 'JUL':
                $mes = 7;
                break;
            case 'AGO':
                $mes = 8;
                break;
            case 'SEP':
                $mes = 9;
                break;
            case 'OCT':
                $mes = 10;
                break;
            case 'NOV':
            case 'NBR':
                $mes = 11;
                break;
            case 'DIC':
            case 'DEC':
            case 'DBR':
                $mes = 12;
                break;
        }
        return $mes;
    }

    private function analizarDia($cadena)
    {
        $resultado = -1;
        switch ($cadena) {
            case "LUNES":
                $resultado = 1;
                break;
            case "MARTES":
                break;
            case "MIERCOLES":
                break;
            case "JUEVES":
                break;
            case "VIERNES":
            case "SABADO":
            case "DOMINGO":
        }
        return $resultado;
    }

    private function calcularFinal($cadena)
    {
        $array = explode(" ", $cadena);
        $count = 0;
        $indice = 0;
        $subCadena = "";
        foreach ($array as $palabra) {
            if (is_numeric($palabra) or $palabra == "Y") {
                $count = 0;
            } elseif ($palabra == "AL") {
                $siguiente = $array[$indice + 1];
                if (is_numeric($siguiente)) {
                    $count = 0;
                } else {
                    break;
                }
            } else {
                $count++;
            }
            if ($count > 2) {
                if ($palabra == "DE") {

                } elseif ($this->analizarMes($palabra) > 0) {

                } elseif (is_numeric($palabra) and count($palabra) <= 4) {

                } else {
                    break;
                }
            } else {
                $subCadena .= "$palabra ";
            }
            $indice++;
        }
        return $subCadena;
    }


    private function analizarNumero($texto)
    {
        $numero = -1;
        switch ($texto) {
            case "UNO":
            case "UN":
                $numero = 1;
                break;
            case "DOS":
                $numero = 2;
                break;
            case "TRES":
                $numero = 3;
                break;
            case "CUATRO":
                $numero = 4;
                break;
            case "CINCO":
                $numero = 5;
                break;
            case "SEIS":
                $numero = 6;
                break;
            case "SIETE":
                $numero = 7;
                break;
            case "OCHO":
                $numero = 8;
                break;
            case "NUEVE":
                $numero = 9;
                break;
            case "DIEZ":
                $numero = 10;
                break;
            case "ONCE":
                $numero = 11;
                break;
            case "DOCE":
                $numero = 12;
                break;
            case "TRECE":
                $numero = 13;
                break;
            case "CATORCE":
                $numero = 14;
                break;
            case "QUINCE":
                $numero = 15;
                break;
        }
        return $numero;
    }

    private function analizarCadenaOpcion2($cadena,$fechaS,$vigencia)
    {
        $resultado = array("EJECUCION" => "", "INICIO" => "", "FIN" => "", "TEXTO" => $cadena);
        $arrayPalabras = explode(" ", $cadena);
        $primera = $arrayPalabras[0];
        if (!is_numeric($primera)) {
            $primera = $this->analizarNumero($primera);
        }
        $segunda = trim($arrayPalabras[1]);
        switch ($segunda) {
            case "MES":
            case "MESES":
                $resultado["EJECUCION"] = "$primera MESES";
                $resultado["INICIO"] = date("Y-m-d");
                $resultado["FIN"] = date("Y-m-d", strtotime("$fechaS + $primera months"));
                break;
            case "DIAS":
                $resultado["EJECUCION"] = "$primera DIAS";
                $resultado["INICIO"] = date("Y-m-d");
                $resultado["FIN"] = date("Y-m-d", strtotime("$fechaS + $primera days"));
                break;
            case "AÑO":
                $resultado["EJECUCION"] = "$primera AÑOS";
                $resultado["INICIO"] = date("Y-m-d");
                $resultado["FIN"] = date("Y-m-d", strtotime("$fechaS + $primera years"));
                break;
            case "PERIODO":
                $resultado = $this->buscar($cadena,$fechaS,$vigencia);
                break;
            case "VIGENCIA":
                $busqInicio = strpos($cadena, "(");
                $busqFin = strpos($cadena, ")");
                if ($busqInicio !== false and $busqFin !== false) {
                    $vigencia = substr($cadena, $busqInicio + 1, $busqFin - $busqInicio - 1);
                    $arrayVigencia = explode(" ", $vigencia);
                    $size = count($arrayVigencia);
                    if ($size > 1) {
                        $size = array_search("VIGENCIA", $arrayPalabras);
                        $year = $arrayPalabras[$size + 1];
                        $mesInicio = $this->analizarMes($arrayVigencia[0]);
                        $mesFin = $this->analizarMes($arrayVigencia[2]);
                        $resultado["EJECUCION"] = 1 + $mesFin - $mesInicio . " MESES";
                        $resultado["INICIO"] = "$year-$mesInicio-01";
                        $resultado["FIN"] = "$year-$mesFin-" . cal_days_in_month(CAL_GREGORIAN, $mesFin, $year);

                    } else {
                        $size = array_search("VIGENCIA", $arrayPalabras);
                        $year = $arrayPalabras[$size + 1];
                        $arrayVigencia = explode("-", $vigencia);
                        $mesInicio = $this->analizarMes($arrayVigencia[0]);
                        $mesFin = $this->analizarMes($arrayVigencia[1]);
                        $resultado["EJECUCION"] = 1 + $mesFin - $mesInicio . " MESES";
                        $resultado["INICIO"] = "$year-$mesInicio-01";
                        $resultado["FIN"] = "$year-$mesFin-" . cal_days_in_month(CAL_GREGORIAN, $mesFin, $year);
                    }
                }
                break;
            default:
                $indice = array_search("SEMESTRE", $arrayPalabras);
                if ($indice !== false) {
                    $cond = $arrayPalabras[$indice + 1];
                    if ($cond == "DEL" or $cond == "DE") {
                        $year = str_replace(".", "", trim($arrayPalabras[$indice + 2]));
                    } else {
                        $year = str_replace(".", "", trim($cond));
                    }

                    $numero = $arrayPalabras[$indice - 1];
                    if (is_numeric($segunda)) {
                        if ($numero == 1) {
                            $resultado["EJECUCION"] = "6 MESES";
                            $resultado["INICIO"] = "$year-01-01";
                            $resultado["FIN"] = "$year-06-" . cal_days_in_month(CAL_GREGORIAN, "06", $year);
                        } else if ($numero == 2) {
                            $resultado["EJECUCION"] = "6 MESES";
                            $resultado["INICIO"] = "$year-07-01";
                            $resultado["FIN"] = "$year-07-" . cal_days_in_month(CAL_GREGORIAN, "07", $year);
                        }
                    } elseif ($numero == "I") {
                        $resultado["EJECUCION"] = "6 MESES";
                        $resultado["INICIO"] = "$year-01-01";
                        $resultado["FIN"] = "$year-06-" . cal_days_in_month(CAL_GREGORIAN, "06", $year);

                    } elseif ($numero == "II") {
                        $resultado["EJECUCION"] = "6 MESES";
                        $resultado["INICIO"] = "$year-07-01";
                        $resultado["FIN"] = "$year-07-" . cal_days_in_month(CAL_GREGORIAN, "07", $year);
                    }
                } else {
                    $resultado = $this->buscar($cadena);
                }
        }
        return $resultado;
    }

    private function validarFechas($cadena,$fechaS,$vigencia)
    {
        $index = strpos($cadena, "EL MES DE");
        if ($index !== false) {
            $resultado = array("EJECUCION" => "", "INICIO" => "", "FIN" => "", "TEXTO" => $cadena);
            $subCadena = substr($cadena, $index + 10);
            $mes = $this->analizarMes($subCadena);
            $resultado["EJECUCION"] = cal_days_in_month(CAL_GREGORIAN, $mes, $vigencia);
            $resultado["INICIO"] = "$vigencia-$mes-1";
            $resultado["FIN"] = "$vigencia-$mes-$resultado[EJECUCION]";
        } else {
            $resultado = $this->analizarCadenaOpcion2($cadena,$fechaS,$vigencia);

        }
        return $resultado;

    }

    function dias_transcurridos($fecha_i, $fecha_f)
    {
        $dias = (strtotime($fecha_i) - strtotime($fecha_f)) / 86400;
        $dias = abs($dias);
        $dias = floor($dias);
        return $dias;
    }

    function analizarCadena($cadena,$fechaS,$vigencia)
    {
        $cadena = trim($cadena);
        $arrayPalabras = explode(" ", $cadena);
        if (count($arrayPalabras) < 2) {
            return false;
        } else {
            $resultado = array("EJECUCION" => "", "INICIO" => "", "FIN" => "", "TEXTO" => $cadena);
            $primera = $arrayPalabras[0];
            $segunda = $arrayPalabras[1];
            $size = count($arrayPalabras);
            if (is_numeric($primera)) {
                switch ($segunda) {
                    case "DE":
                        if ($size == 3) {
                            $diaI = $primera;
                            $mesI = $this->analizarMes($arrayPalabras[2]);
                            $resultado["INICIO"] = "$vigencia-$mesI-$diaI";
                            $resultado["FIN"] = $resultado["INICIO"];
                            $resultado["EJECUCION"] = "1 DIAS";
                        } elseif ($size == 7 and $arrayPalabras[3] == "AL") {
                            $diaI = $primera;
                            $mesI = $this->analizarMes($arrayPalabras[2]);
                            $diaF = $arrayPalabras[4];
                            $mesF = $this->analizarMes($arrayPalabras[6]);
                            $resultado["INICIO"] = "$vigencia-$mesI-$diaI";
                            $resultado["FIN"] = "$vigencia-$mesF-$diaF";
                            $resultado["EJECUCION"] = $this->dias_transcurridos($resultado["INICIO"], $resultado["FIN"]) . " DIAS";

                        }
                        break;
                    case "AL":
                        if ($size == 5) {
                            $diaI = $primera;
                            $diaF = $arrayPalabras[2];
                            $mesI = $this->analizarMes($arrayPalabras[4]);
                            $resultado["INICIO"] = "$vigencia-$mesI-$diaI";
                            $resultado["FIN"] = "$vigencia-$mesI-$diaF";
                            $resultado["EJECUCION"] = $this->dias_transcurridos($resultado["INICIO"], $resultado["FIN"]) . " DIAS";
                        }
                        break;
                    default:
                        $indice = array_search("Y", $arrayPalabras);
                        $estado = true;
                        if ($indice !== false) {
                            for ($i = $indice - 1; $i >= 0; $i--) {
                                $palabra = $arrayPalabras[$i];
                                if (!is_numeric($palabra)) {
                                    $estado = false;
                                    break;
                                } else {
                                    $cifras = strlen($palabra);
                                    if ($cifras > 2) {
                                        $estado = false;
                                        break;
                                    }
                                }
                            }
                            if ($estado) {
                                $diaI = $arrayPalabras[0];
                                $diaF = $arrayPalabras[$indice + 1];
                                $mesI = $this->analizarMes($arrayPalabras[$indice + 3]);
                                $resultado["INICIO"] = "$vigencia-$mesI-$diaI";
                                $resultado["FIN"] = "$vigencia-$mesI-$diaF";
                                $resultado["EJECUCION"] = $this->dias_transcurridos($resultado["INICIO"], $resultado["FIN"]) . " DIAS";
                            } else {
                                $resultado = false;
                            }
                        } else {
                            $resultado = false;
                        }
                    /*
                    $indice =array_search("Y",$arrayPalabras);
                    if($indice!==false){
                        $arrayPalabras[$indice+1];
                    }*/

                }
            } else {
                $resultado = false;
            }
            return $resultado;
        }


    }

    private function buscar($cadena,$fechaS,$vigencia)
    {
        $resultado = false;
        $arrayPalabras = explode(" ", $cadena);
        foreach ($arrayPalabras as $palabra) {
            if (is_numeric($palabra)) {
                $index = strpos($cadena, $palabra);
                $inicio = substr($cadena, $index);
                $subCadena = $this->calcularFinal($inicio);
                $resultado = $this->analizarCadena($subCadena,$fechaS,$vigencia);
                if (is_array($resultado)) {
                    return $resultado;
                }
            }
        }


        return $resultado;
    }

    /**
     * Traduce un objeto de contrato
     * @param string $cadena
     * @return string
     */
    public function traducir($cadena,$fechaS,$vigencia)
    {
        $tipo = strpos($cadena, "DURANTE");
        if ($tipo !== false) {
            $cad = substr($cadena, $tipo + 8);
            //$número = cal_days_in_month(CAL_GREGORIAN, $this->analizarMes($cad), 2017);
            return $this->validarFechas($cad,$fechaS,$vigencia);
        } else {
            $tipo = strpos($cadena, "TIEMPO DE EJECUCION");
            if ($tipo !== false) {
                $cad = substr($cadena, $tipo + 20);
                return $this->analizarCadenaOpcion2($cad,$fechaS,$vigencia);

            } else {
                return $this->buscar($cadena,$fechaS,$vigencia);
            }
        }

    }

    /*
    $array =[];
    if (strpos($cadena, "RENOVACION") !== false or strpos($cadena, "EXPEDICION") !== false) {
        $array["poliza"] = "si";
    }
    else $array["poliza"]="no";

    $pos = strpos($cadena, "LOS DIAS");
    if ($pos !== false) {
        $cad = substr($cadena, $pos + 9);
        $arrayPalabras =explode(" ",$cad);
        foreach ($arrayPalabras as $pal){
            if(is_numeric($pal)){

            }
        }

    } else {
        return "no esta";
    }

    $palabras =explode(" ",$cadena);
    $i=0;
    foreach($palabras as $palabra){
        if(is_numeric($palabras)){

        }
        $i++;
    }

    return $array;*/
}