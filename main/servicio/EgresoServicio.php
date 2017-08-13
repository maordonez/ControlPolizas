<?php

/**
 * Created by PhpStorm.
 * User: miuguel
 * Date: 04/06/2017
 * Time: 06:20 PM
 */
require_once __DIR__.'/../fabrica/FabricaDAO.php';
class EgresoServicio
{
    private $fabrica;

    public function __construct()
    {
        $this->fabrica = new FabricaDAO(true);
    }
    /**
     *
     * @param EgresoDTO $dto
     * @return string
     */
    public function registrarEgreso($dto)
    {
        $respuesta = array("estado" => FALSE, "mensaje" => "Error de registro");
        $egresoDAO = $this->fabrica->construir("EgresoDAO");
        $egresoDTO = $egresoDAO->buscar($dto->getEgreso());
        if ($egresoDTO == null) {
            $dto->setFechaMov($this->formatoDatepicker($dto->getFechaMov()));
            if ($egresoDAO->registrar($dto)) {
                $respuesta["estado"] = TRUE;
                $respuesta["mensaje"] = "Egreso Registrado";
            }
        } else {
            $respuesta["estado"] = FALSE;
            $respuesta["mensaje"] = "Egreso ya existe";
        }

        $this->fabrica->close();
        return $respuesta;
    }

    /**
     *
     * @param String $id
     * @return array()
     */
    public function eliminarEgreso($id)
    {
        $respuesta = array("estado" => FALSE, "mensaje" => "Error de eliminacion");
        $egresoDAO = $this->fabrica->construir("EgresoDAO");
        if ($egresoDAO->eliminar($id)) {
            $respuesta["estado"] = TRUE;
            $respuesta["mensaje"] = "Egreso Eliminado";
        }
        $this->fabrica->close();
        return $respuesta;
    }

    public function actualizarEgresos($dto)
    {
        $respuesta = array("estado" => FALSE, "mensaje" => "Error de actualizacion");
        $egresoDAO = $this->fabrica->construir("EgresoDAO");
        $dto->setFechaMov($this->formatoDatepicker($dto->getFechaMov()));
        if ($egresoDAO->actualizar($dto)) {
            $respuesta["estado"] = TRUE;
            $respuesta["mensaje"] = "Egreso actualizado";
        }
        $this->fabrica->close();
        return $respuesta;
    }

    private function formatoDatepicker($cadena)
    {
        $array = explode("/", $cadena);
        return "$array[2]-$array[0]-$array[1]";
    }

}