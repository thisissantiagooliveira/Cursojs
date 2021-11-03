<?php
class Unidade{

private $id;
private $nome;
private $sigla;

//construtor


public function __construct($id, $nome, $sigla){
	
	$this -> id = $id;
	$this -> nome = $nome;
	$this -> sigla = $sigla;

}
	//gets and sets
	
	public function getId(){
		return $this -> id;
	}
	public function setId($id){
		$this ->id = $id;
	}
	
	public function getNome(){
		return $this -> nome;
	}

	public function setNome($nome){
		$this -> nome = $nome;
	}
	
	public function getSigla(){
		return $this -> sigla;
	}
	
	public function setSigla($sigla){
		$this -> sigla = $sigla;
	}
}

?>