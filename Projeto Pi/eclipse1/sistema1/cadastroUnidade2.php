<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Cadastro Unidade</title>
</head>

<body>
	
	<?php
	
	$id = $_GET['id'];
	$nome = $_GET['nome'];
	$sigla = $_GET['sigla'];
	
	if($nome == "" ) {
		echo("Digite o Nome");
	}
	else if ($sigla == ""){
		echo("Digite a Sigla");
	}
	else{
		echo("Cadastro Efetuado com Sucesso!");
	}
	
	
	?>
	
	
	
	
</body>
</html>