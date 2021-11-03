<?php
namespace src;

class Movimentacao
{
    private $id;
    private $Status;
    private $Ambienteorigem;
    private $Ambientedestino;
    private $Ativo;
    private $Usuario;
    private $dataEntrada;
    private $dataSaida;
    private $dataCad;
    private $motivo;
    private $descricao;

    public function __construct()
    {}
   
    public function getId()
    {
        return $this->id;
    }

    public function getStatus()
    {
        return $this->Status;
    }

   
    public function getAmbienteorigem()
    {
        return $this->Ambienteorigem;
    }

   
    public function getAmbientedestino()
    {
        return $this->Ambientedestino;
    }

   
    public function getAtivo()
    {
        return $this->Ativo;
    }

   
    public function getUsuario()
    {
        return $this->Usuario;
    }

  
    public function getDataEntrada()
    {
        return $this->dataEntrada;
    }

   
    public function getDataSaida()
    {
        return $this->dataSaida;
    }

   
    public function getDataCad()
    {
        return $this->dataCad;
    }

   
    public function getMotivo()
    {
        return $this->motivo;
    }

  
    public function getDescricao()
    {
        return $this->descricao;
    }

   
    public function setId($id)
    {
        $this->id = $id;
    }

   
    public function setStatus($Status)
    {
        $this->Status = $Status;
    }

  
    public function setAmbienteorigem($Ambienteorigem)
    {
        $this->Ambienteorigem = $Ambienteorigem;
    }

   
    public function setAmbientedestino($Ambientedestino)
    {
        $this->Ambientedestino = $Ambientedestino;
    }

  
    public function setAtivo($Ativo)
    {
        $this->Ativo = $Ativo;
    }

    public function setUsuario($Usuario)
    {
        $this->Usuario = $Usuario;
    }

    public function setDataEntrada($dataEntrada)
    {
        $this->dataEntrada = $dataEntrada;
    }

    public function setDataSaida($dataSaida)
    {
        $this->dataSaida = $dataSaida;
    }

 
    public function setDataCad($dataCad)
    {
        $this->dataCad = $dataCad;
    }

  
    public function setMotivo($motivo)
    {
        $this->motivo = $motivo;
    }


    public function setDescricao($descricao)
    {
        $this->descricao = $descricao;
    }


    
  
    
}
?>
