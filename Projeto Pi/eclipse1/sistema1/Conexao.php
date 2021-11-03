<?php

//importa o drive do mysql
use mysqli;
	
class Conexao{
	private $conexao;
	private $servidor;
	private $banco;
	private $usuario;
	private $senha;
	private $charset;
	private $url;
	
	public function __construct(){
		$this -> servidor = "localhost";
		$this -> usuario = "root";
		$this -> senha = "123456";
		$this -> banco = "cpc68";
		$this -> charset = "utf8";
	}
	
	public function abrirConexao(){
		$this -> conexao = new mysqli( $this -> servidor, 
										$this -> usuario,
										$this -> senha,
										$this ->banco);
		
		if(!$this -> conexao){
			
			echo("Falha na conexão");
		}
		else{
			return $this -> conexao;
		}
		
	}
	
	public function fecharConexao(){
		$this -> conexao -> close();
		
		if(!$this -> conexao){
			echo("Falha no fechamento da conexão");
		}
		else{
			return $this -> conexao;
		}
	}
	
	public function getConexao(){
		return $this -> conexao;
	}
}







?>