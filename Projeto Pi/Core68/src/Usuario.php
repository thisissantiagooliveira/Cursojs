<?php
namespace src;

class Usuario
{
    private $id;
    private $nome;
    private $login;
    private $senha;
    private $nivel;
    private $idsuperior;
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


    public function getLogin()
    {
        return $this->login;
    }


    public function getSenha()
    {
        return $this->senha;
    }


    public function getNivel()
    {
        return $this->nivel;
    }


    public function getIdsuperior()
    {
        return $this->idsuperior;
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


    public function setLogin($login)
    {
        $this->login = $login;
    }


    public function setSenha($senha)
    {
        $this->senha = $senha;
    }


    public function setNivel($nivel)
    {
        $this->nivel = $nivel;
    }


    public function setIdsuperior($idsuperior)
    {
        $this->idsuperior = $idsuperior;
    }


    public function setSituacao($situacao)
    {
        $this->situacao = $situacao;
    }


    
    
}
?>
