<?php

class RepositorioUnidade{
	
	private $Unidade;
	private $Conexao;
	
	public function __construct(){
		$this -> Unidade = new Unidade();
		$this -> Conexao = new Conexao();
	}
	
	public function cadastarUnidade($Unidade){
		$retorno = FALSE;
		
		
		$codigoSQL= "INSERT INTO UNIDADE (NOME, SIGLA) VELUES".
			"('".$Unidade -> getNome()."',".
			"'".$Unidade -> getSigla()."')";
		
		$this ->Conexao ->abriConexao();
		
		if($this->Conexao()->execute($codigoSQL) == TRUE){
			$retorno = TRUE;
		}
		else {
			echo("Erro no Codigo SQL");
		}
		
		 $this->Conexao->fecharConexao();
		
		return $retorno;
	}
	
	
	public function existeUnidade($Unidade){
		$retorno = FALSE;
		
		$codigoSQL= "SELECT * FROM UNIDADE".
			"WHERE NOME = '".$Unidade -> getNome()."' ".
			"OR SIGLA = '".$Unidade -> GETsIGLA()."'";
		
		$this ->Conexao ->abriConexao();
		
		$this->Conexao->getConexao()->executequery($codigoSQL);
		
		if($resultado){
			$retorno = TRUE;
		}
		
		 $this->Conexao->fecharConexao();
		
		return $retorno;
	}
}






?>