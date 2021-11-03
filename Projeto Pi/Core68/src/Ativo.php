<?php
namespace src;

class Ativo
{
    private $id;
    private $nome;
    private $codigobarra;
    private $descricao;
    private $SubGrupo;
    private $Ambiente;
    private $Status;
    private $Usuario;
    private $data;
    private $situacao;
    
    public function __construct()
    {}

    
    public function getId()
    {
        return $this->id;
    }


    public function getNome()
    {
        return $this->nome;
    }


    public function getCodigobarra()
    {
        return $this->codigobarra;
    }


    public function getDescricao()
    {
        return $this->descricao;
    }


    public function getSubGrupo()
    {
        return $this->SubGrupo;
    }


    public function getAmbiente()
    {
        return $this->Ambiente;
    }


    public function getStatus()
    {
        return $this->Status;
    }


    public function getUsuario()
    {
        return $this->Usuario;
    }


    public function getData()
    {
        return $this->data;
    }


    public function getSituacao()
    {
        return $this->situacao;
    }


    public function setId($id)
    {
        $this->id = $id;
    }


    public function setNome($nome)
    {
        $this->nome = $nome;
    }


    public function setCodigobarra($codigobarra)
    {
        $this->codigobarra = $codigobarra;
    }


    public function setDescricao($descricao)
    {
        $this->descricao = $descricao;
    }


    public function setSubGrupo($SubGrupo)
    {
        $this->SubGrupo = $SubGrupo;
    }


    public function setAmbiente($Ambiente)
    {
        $this->Ambiente = $Ambiente;
    }


    public function setStatus($Status)
    {
        $this->Status = $Status;
    }


    public function setUsuario($Usuario)
    {
        $this->Usuario = $Usuario;
    }


    public function setData($data)
    {
        $this->data = $data;
    }


    public function setSituacao($situacao)
    {
        $this->situacao = $situacao;
    }
    
    
   
}





   
  