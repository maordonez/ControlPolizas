<?php

/**
 * Created by PhpStorm.
 * User: miuguel
 * Date: 15/06/2017
 * Time: 12:13 AM
 */
class PersonaDTO
{
    private $nit;
    private $razonSocial;
    private $tipoPersona;
    private $vinculo;

    public function __construct($nit,$razon,$tipo,$vinculo)
    {
        $this->nit=$nit;
        $this->razonSocial=$razon;
        $this->tipoPersona=$tipo;
        $this->vinculo=$vinculo;
    }

    /**
     * @return mixed
     */
    public function getNit()
    {
        return $this->nit;
    }

    /**
     * @param mixed $nit
     */
    public function setNit($nit)
    {
        $this->nit = $nit;
    }

    /**
     * @return mixed
     */
    public function getRazonSocial()
    {
        return $this->razonSocial;
    }

    /**
     * @param mixed $razonSocial
     */
    public function setRazonSocial($razonSocial)
    {
        $this->razonSocial = $razonSocial;
    }

    /**
     * @return mixed
     */
    public function getTipoPersona()
    {
        return $this->tipoPersona;
    }

    /**
     * @param mixed $tipoPersona
     */
    public function setTipoPersona($tipoPersona)
    {
        $this->tipoPersona = $tipoPersona;
    }

    /**
     * @return mixed
     */
    public function getVinculo()
    {
        return $this->vinculo;
    }

    /**
     * @param mixed $vinculo
     */
    public function setVinculo($vinculo)
    {
        $this->vinculo = $vinculo;
    }



}