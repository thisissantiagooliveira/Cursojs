<?php
namespace src;

class Cargo
{
    private $id;
    private $nome;
    private $Usuario;
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

    public function getUsuario()
    {
        return $this->Usuario;
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


    public function setUsuario($Usuario)
    {
        $this->Usuario = $Usuario;
    }


    public function setSituacao($situacao)
    {
        $this->situacao = $situacao;
    }

    
    
    
}
?>

