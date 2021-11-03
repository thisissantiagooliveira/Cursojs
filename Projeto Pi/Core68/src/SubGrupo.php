<?php
namespace src;

class SubGrupo
{
    private $id;
    private $nome;
    private $Grupo;
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

  
    public function getGrupo()
    {
        return $this->Grupo;
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

    
    public function setGrupo($Grupo)
    {
        $this->Grupo = $Grupo;
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
