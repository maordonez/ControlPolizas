<?php

/**
 * Created by PhpStorm.
 * User: miuguel
 * Date: 14/06/2017
 * Time: 11:25 PM
 */
require_once __DIR__.'/../fabrica/FabricaDAO.php';
class PersonaServicio
{
    private $fabrica;

    public function __construct()
    {
        $this->fabrica = new FabricaDAO(true);
    }
    public function listar(){
        $respuesta =[];
        $personaDAO=$this->fabrica->construir("PersonaDAO");
        $respuesta=$personaDAO->listar();
        $this->fabrica->close();
        return $respuesta;
    }

    /**
     * @param PersonaDTO $dto
     * @return array
     */
    public function actualizar($dto){
        $array = array("estado"=>false,"mensaje"=>"Error actualizacion");
        $personaDAO=$this->fabrica->construir("PersonaDAO");
        $estado=$personaDAO->existe($dto->getNit(),$dto->getRazonSocial());
        if($estado){
            $estadoR=$personaDAO->actualizar($dto);
            if($estadoR){
                $array["estado"]=true;
                $array["mensaje"]="Actualizacion exitosa";
            }
        }
        $this->fabrica->close();
        return $array;
    }

    /**
     * @param PersonaDTO $dto
     * @return array
     */
    public function registro($dto){
        $array = array("estado"=>false,"mensaje"=>"Error registro");
        $personaDAO=$this->fabrica->construir("PersonaDAO");
        $estado=$personaDAO->existe($dto->getNit(),$dto->getRazonSocial());
        if(!$estado){
            $estadoR=$personaDAO->registrar($dto->getNit(), $dto->getRazonSocial(), $dto->getTipoPersona(), $dto->getVinculo());
            if($estadoR){
                $array["estado"]=true;
                $array["mensaje"]="Registro exitoso";
            }
        }
        else{
            $array["mensaje"]="La persona ya existe";
        }
        $this->fabrica->close();
        return $array;
    }
    public function busqueda($nit,$razon){
        $resultado=false;
        $personaDAO=$this->fabrica->construir("PersonaDAO");
        $resultado=$personaDAO->buscar($nit,$razon);
        $this->fabrica->close();
        return $resultado;
    }

}