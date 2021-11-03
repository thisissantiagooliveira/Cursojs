<?php
session_start();

include_once 'src/Funcionario.php';
include_once 'src/FuncionarioRepositorio.php';
include_once 'src/Usuario.php';

use src\Funcionario;
use src\Usuario;
use src\FuncionarioRepositorio;

if(!isset($_SESSION['logou'])|| $_SESSION['logou'] != TRUE){
    header('Location: index.php');
}
else if($_SESSION['nivel'] == 3){
    header('Location: telaPrincipal.php');
}
else{
    ?>
<!doctype html>
<html>
<head>
<title>Sistema</title>
<meta charset="UTF-8"/>
</head>
<body>
<?php echo($_SESSION['nome']);?> <a href="sairSistema.php">Sair</a>

<?php 
if($_SESSION['nivel'] == 1){
?>    
<a href="cadastrarUsuario.php"><img src="img\quad.jpg" width="9" align="center"> Cadastrar Usuario</a>
<a href="consultarUsuario.php"><img src="img\quad.jpg" width="9" align="center"> Consultar Usuario</a>
<a href="alterarUsuario.php"><img src="img\quad.jpg" width="9" align="center"> Alterar Usuario</a>
<a href="bloquearUsuario.php"><img src="img\quad.jpg" width="9" align="center"> Bloqueio de Usuario</a>
<a href="desbloquearUsuario.php"><img src="img\quad.jpg" width="9" align="center"> Desbloqueio de Usuario</a>
<a href="excluirUsuario.php"><img src="img\quad.jpg" width="9" align="center"> Excluir Usuarios</a>

<span style="color:#FF6E06; padding-left:30px; font-size:18px;">Relatorios</span>

	
<a href="listaTodos.php"><img src="img\quad.jpg" width="9" align="center">  Lista Todos Usuarios</a>
<a href="listaBloqueados.php"><img src="img\quad.jpg" width="9" align="center">  Lista Bloqueados</a>
<a href="listaDesbloqueados.php"><img src="img\quad.jpg" width="9" align="center">  Lista Desbloqueados</a>
<a href="listaPorNivel.php"><img src="img\quad.jpg" width="9" align="center">  Lista Por Nivel</a>
<a href="listaPorSuperior.php"><img src="img\quad.jpg" width="9" align="center">  Lista Por Superior</a>
<a href="alterarSenha.php"><img src="img\quad.jpg" width="9" align="center">  Alterar Senha</a>
<a href="alterarPerfil.php"><img src="img\quad.jpg" width="9" align="center">  Alterar Perfil</a>

<?php 
}
?>
<?php 
if($_SESSION['nivel'] == 2){
?>
<a href="cadastrarUsuario.php"><img src="img\quad.jpg" width="9" align="center"> Cadastrar Usuario</a>
<a href="consultarUsuario.php"><img src="img\quad.jpg" width="9" align="center"> Consultar Usuario</a>
<a href="alterarUsuario.php"><img src="img\quad.jpg" width="9" align="center"> Alterar Usuario</a>
<a href="bloquearUsuario.php"><img src="img\quad.jpg" width="9" align="center"> Bloqueio de Usuario</a>
<a href="desbloquearUsuario.php"><img src="img\quad.jpg" width="9" align="center"> Desbloqueio de Usuario</a>

<span style="color:#FF6E06; padding-left:30px; font-size:18px;">Relatorios</span>

	
<a href="listaTodos.php"><img src="img\quad.jpg" width="9" align="center">  Lista Todos Usuarios</a>
<a href="listaBloqueados.php"><img src="img\quad.jpg" width="9" align="center">  Lista Bloqueados</a>
<a href="listaDesbloqueados.php"><img src="img\quad.jpg" width="9" align="center">  Lista Desbloqueados</a>
<a href="listaPorNivel.php"><img src="img\quad.jpg" width="9" align="center">  Lista Por Nivel</a>
<a href="listaPorSuperior.php"><img src="img\quad.jpg" width="9" align="center">  Lista Por Superior</a>
<a href="alterarSenha.php"><img src="img\quad.jpg" width="9" align="center">  Alterar Senha</a>
<a href="alterarPerfil.php"><img src="img\quad.jpg" width="9" align="center">  Alterar Perfil</a>

<?php 
}
?>
<?php 
if($_SESSION['nivel'] == 3){
?>
<span style="color:#FF6E06; padding-left:30px; font-size:18px;">Relatorios</span>
	
<a href="listaTodos.php"><img src="img\quad.jpg" width="9" align="center">  Lista Todos Usuarios</a>
<a href="listaBloqueados.php"><img src="img\quad.jpg" width="9" align="center">  Lista Bloqueados</a>
<a href="listaDesbloqueados.php"><img src="img\quad.jpg" width="9" align="center">  Lista Desbloqueados</a>
<a href="listaPorNivel.php"><img src="img\quad.jpg" width="9" align="center">  Lista Por Nivel</a>
<a href="listaPorSuperior.php"><img src="img\quad.jpg" width="9" align="center">  Lista Por Superior</a>
<a href="alterarSenha.php"><img src="img\quad.jpg" width="9" align="center">  Alterar Senha</a>
<a href="alterarPerfil.php"><img src="img\quad.jpg" width="9" align="center">  Alterar Perfil</a>

<?php 

}
?>
<?php 
$nome = $_GET['nome'];
$id = $_SESSION['id'];

$Usuario = new Usuario();
$Usuario->setId(strip_tags(trim($id)));

$Funcionario = new Funcionario();
$Funcionario->setNome($nome);
$Funcionario->setUsuario($Usuario);





$FuncionarioRepositorio = new FuncionarioRepositorio();

if ($nome != ""){
    $Funcionario = $FuncionarioRepositorio->consultarFuncionarioDesbloqueadoPorNome($Funcionario);
}

if($Funcionario->getNome() == ""){
    
    echo "Funcionario não encontrado";
}
else{
    
}
?>

<h3>Bloquear a Funcionario do Sistema</h3>
<form action="bloquearFuncionario3.php" method="get">
<label>Nome: </label>
<input readonly type="text" name="nome" size="25" value="<?php echo $Funcionario->getNome(); ?>"><br/><br/>

<label>Turno: </label>
<input readonly type="text" name="turno" size="25" value="<?php echo $Funcionario->getTurno(); ?>"><br/><br/>

<label>Data Cadastro:</label>
<input readonly type="text" name="data" size="25" value="<?php echo $Funcionario->getData(); ?>"><br/><br/>

<label>Superior:</label>
<input readonly type="text" name="idSuperviso" size="25" value="<?php echo $Funcionario->getSuperior(); ?>"><br/><br/>

<label>Usuario:</label>
<input readonly type="text" name="idUsuario" size="25" value="<?php echo $Funcionario->getUsuario(); ?>"><br/><br/>

<label>Unidade:</label>
<input readonly type="text" name="idUnidade" size="25" value="<?php echo $Funcionario->getUnidade(); ?>"><br/><br/>

<label>Cargo:</label>
<input readonly type="text" name="idCargo" size="25" value="<?php echo $Funcionario->getCargo(); ?>"><br/><br/>

<input type="hidden" name="situacao" value="<?php echo $Funcionario->getSituacao()?>" >
<input type="hidden" name="id" value="<?php echo $Funcionario->getId()?>" >
<input type="submit" value="Bloquear"/>
</form>
</body>
</html>   
<?php 
}
?> 
