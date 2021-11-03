<?php
namespace src;
use mysqli;
class Conexao
{
    private $conexao;
    private $servidor;
    private $banco;
    private $usuario;
    private $senha;
    private $charset;
    
    public function __construct()
    {
        $this -> servidor = "localhost";
        $this -> banco = "CORE68";
        $this ->usuario ="root";
        $this -> senha ="123456";
        $this -> charset = "UTF8";
    }
    
    public function abrirConexao(){
        $this -> conexao = new mysqli(
            $this -> servidor,
            $this -> usuario,
            $this -> senha,
            $this -> banco);
        if(!$this->conexao){
            echo("Falha na conexão:".mysqli_error($this ->conexao));
        }
        else{
            return $this -> conexao;
        }
    }
    
    public function fecharBanco(){
        if(!$this ->conexao ->close()){
            echo("Falha ao encerrar a conexao".mysqli_error($this ->conexao));
        }
        
    }
    
    public function getConexao(){
        return $this -> conexao;
    }
}
?>

