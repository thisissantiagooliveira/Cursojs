<?php
namespace src;

class Unidade
{

    private $id;
    private $nome;
    private $data;
    private $Usuario;
    private $sigla;
    private $endereco;
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

    
    public function getData()
    {
        return $this->data;
    }


    public function getUsuario()
    {
        return $this->Usuario;
    }


    public function getSigla()
    {
        return $this->sigla;
    }


    public function getEndereco()
    {
        return $this->endereco;
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


    public function setData($data)
    {
        $this->data = $data;
    }


    public function setUsuario($Usuario)
    {
        $this->Usuario = $Usuario;
    }


    public function setSigla($sigla)
    {
        $this->sigla = $sigla;
    }


    public function setEndereco($endereco)
    {
        $this->endereco = $endereco;
    }


    public function setSituacao($situacao)
    {
        $this->situacaoS = $situacao;
    }

    

   
}
?>
