<?php
namespace src;

class Funcionario
{
    private $id;
    private $nome;
    private $Cargo;
    private $turno;
    private $superior;
    private $Unidade;
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


    public function getCargo()
    {
        return $this->Cargo;
    }


    public function getTurno()
    {
        return $this->turno;
    }


    public function getSuperior()
    {
        return $this->superior;
    }


    public function getUnidade()
    {
        return $this->Unidade;
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


    public function setCargo($Cargo)
    {
        $this->Cargo = $Cargo;
    }


    public function setTurno($turno)
    {
        $this->turno = $turno;
    }


    public function setSuperior($superior)
    {
        $this->superior = $superior;
    }


    public function setUnidade($Unidade)
    {
        $this->Unidade = $Unidade;
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
?>
