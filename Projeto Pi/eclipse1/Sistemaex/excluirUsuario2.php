<?php
session_start();

include_once 'src/Usuario.php';
include_once 'src/UsuarioRepositorio.php';

use src\Usuario;
use src\UsuarioRepositorio;

if(!isset($_SESSION['logou'])|| $_SESSION['logou'] != TRUE){
    header('Location: index.php');
}
else if($_SESSION['nivel'] != 1){
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
<style>
a{
color:#8B9BA8; 
text-decoration: none;
padding-left:30px; 
font-size:18px;
}
a:hover{
text-decoration: underline;
}
</style>
<body>
<table width="1000" border="0"
cellspacing="0" cellspading="0">

<tr style="background-color:#005497;">
<td colspan="2">
	<table wider="100%" border="0" cellspacing="0" cellspading="0">
	<tr style="background-color:#005497; height: 50px;">
	<td wider="60%"><span style="color:#ffffff; padding-left:15px; ">UTIC - unidade de Tecnologia da Informação e Comunicação</span></td>
	<td wider="40%" align="right"><span style="color:#ffffff; padding-left:410px;"> <?php echo($_SESSION['nome']);?>  <?php echo($_SESSION['login']);?> <img src="img\perfil.png" width="30" align="center" ></span></td>
	</tr>
	</table>
</td>
</tr>

<tr>
<td colspan="2">
<table wider="100%" border="0" cellspacing="0" cellspading="0">
	<tr style=" height: 90px;">
	<td wider="30%"><img src="img\logo.png" width="200" style="padding-left:30px"></td>
	<td wider="70%" align="center">
	<span style="padding-left:100px">
	<img src="img\home6.png"	height="40">&nbsp;
	<img src="img\utic.png"		height="40">&nbsp;
	<img src="img\equipe.png" 	height="40">&nbsp;
	<img src="img\noticias.png" height="40">&nbsp;
	<img src="img\cursos5.png" height="40">&nbsp;
	<img src="img\turmas5.png" height="40">&nbsp;
	<img src="img\ambiente2.png" height="40">&nbsp;
	</span>
	</td>
	</tr>
	</table>
</td>
</tr>

<tr>
<td width="30%">
<table width="100%" border="0" cellspacing="0" cellspading="0">
<tr>
<td height="40"><span style="color:#FF7226; font-size:14px; font-family: century Gothic; padding-left:30px ">Painel</span> <img src="img\seta.jpg" align="center" width="10"/>
<span style="color:#898591; font-size:14px; font-family: century Gothic;"> Admistração do site </span><img src="img\seta.jpg" align="center" width="10"/></td>
</tr>
<tr>
<td>&nbsp;</td>
</tr>
<tr>
<td width="30%">
<span style="color:#FF6E06; padding-left:30px; font-size:18px;">Painel de Controle</span></td>
</tr>
<tr>
<td>&nbsp;</td>
</tr>
<tr>
<?php 
if($_SESSION['nivel'] == 1){
?>    
<td><a href="cadastrarUsuario.php"><img src="img\quad.jpg" width="9" align="center"> Cadastrar Usuario</a></td>
</tr>
<tr>
<td><a href="consultarUsuario.php"><img src="img\quad.jpg" width="9" align="center"> consultar Usuario</a></td>
</tr>
<tr>
<td><a href="alterarUsuario.php"><img src="img\quad.jpg" width="9" align="center"> Alterar Usuario</a></td>
</tr>
<tr>
<td><a href="bloquearUsuario"><img src="img\quad.jpg" width="9" align="center"> Bloqueio de Usuario</a></td>
</tr>
<tr>
<td><a href="desbloquearUsuario.php"><img src="img\quad.jpg" width="9" align="center"> Desbloqueio de Usuario</a></td>
</tr>
<tr>
<td><a href="excluirUsuario.php"><img src="img\quad.jpg" width="9" align="center"> Excluir Usuarios</a></td>
</tr>
<tr>
<td>&nbsp;</td>
</tr>
<tr>	
<td width="30%">
<span style="color:#FF6E06; padding-left:30px; font-size:18px;">Relatorios</span></td>
</tr>
<tr>
<td>&nbsp;</td>
</tr>
	
<tr>
<td><a href="listaTodos.php"><img src="img\quad.jpg" width="9" align="center">  Lista Todos Usuarios</a></td>
</tr>
<tr>
<td><a href="listaBloqueados.php"><img src="img\quad.jpg" width="9" align="center">  Lista Bloqueados</a></td>
</tr>
<tr>
<td><a href="listaDesbloqueados.php"><img src="img\quad.jpg" width="9" align="center">  Lista Desbloqueados</a></td>
</tr>
<tr>
<td><a href="listaPorNivel.php"><img src="img\quad.jpg" width="9" align="center">  Lista Por Nivel</a></td>
</tr>
<tr>
<td><a href="listaPorSuperior.php"><img src="img\quad.jpg" width="9" align="center">  Lista Por Superior</a></td>
</tr>
<tr>
<td><a href="alterarSenha.php"><img src="img\quad.jpg" width="9" align="center">  Alterar Senha</a></td>
</tr>
<tr>
<td><a href="alterarPerfil.php"><img src="img\quad.jpg" width="9" align="center">  Alterar Perfil</a></td>
</tr>
<tr>
<td>&nbsp;</td>
</tr>
<?php 
}
?>
<?php 
if($_SESSION['nivel'] == 2){
?>
<td><a href="'cadastrarUsuario.php'"><img src="img\quad.jpg" width="9" align="center"> Cadastrar Usuario</a></td>
</tr>
<tr>
<td><a href="consultarUsuario.php"><img src="img\quad.jpg" width="9" align="center"> consultar Usuario</a></td>
</tr>
<tr>
<td><a href="alterarUsuario.php"><img src="img\quad.jpg" width="9" align="center"> Alterar Usuario</a></td>
</tr>
<tr>
<td><a href="bloquearUsuario"><img src="img\quad.jpg" width="9" align="center"> Bloqueio de Usuario</a></td>
</tr>
<tr>
<td><a href="desbloquearUsuario.php"><img src="img\quad.jpg" width="9" align="center"> Desbloqueio de Usuario</a></td>
</tr>
<tr>
<td>&nbsp;</td>
</tr>
<tr>	
<td width="30%">
<span style="color:#FF6E06; padding-left:30px; font-size:18px;">Relatorios</span></td>
</tr>
<tr>
<td>&nbsp;</td>
</tr>
	
<tr>
<td><a href="listaTodos.php"><img src="img\quad.jpg" width="9" align="center">  Lista Todos Usuarios</a></td>
</tr>
<tr>
<td><a href="listaBloqueados.php"><img src="img\quad.jpg" width="9" align="center">  Lista Bloqueados</a></td>
</tr>
<tr>
<td><a href="listaDesbloqueados.php"><img src="img\quad.jpg" width="9" align="center">  Lista Desbloqueados</a></td>
</tr>
<tr>
<td><a href="listaPorNivel.php"><img src="img\quad.jpg" width="9" align="center">  Lista Por Nivel</a></td>
</tr>
<tr>
<td><a href="listaPorSuperior.php"><img src="img\quad.jpg" width="9" align="center">  Lista Por Superior</a></td>
</tr>
<tr>
<td><a href="alterarSenha.php"><img src="img\quad.jpg" width="9" align="center">  Alterar Senha</a></td>
</tr>
<tr>
<td><a href="alterarPerfil.php"><img src="img\quad.jpg" width="9" align="center">  Alterar Perfil</a></td>
</tr>
<tr>
<td>&nbsp;</td>
</tr>
<?php
}
?>
<?php 
if($_SESSION['nivel'] == 3){
?>
<tr>	
<td width="30%">
<span style="color:#FF6E06; padding-left:30px; font-size:18px;">Relatorios</span></td>
</tr>
<tr>
<td>&nbsp;</td>
</tr>
	
<tr>
<td><a href="listaTodos.php"><img src="img\quad.jpg" width="9" align="center">  Lista Todos Usuarios</a></td>
</tr>
<tr>
<td><a href="listaBloqueados.php"><img src="img\quad.jpg" width="9" align="center">  Lista Bloqueados</a></td>
</tr>
<tr>
<td><a href="listaDesbloqueados.php"><img src="img\quad.jpg" width="9" align="center">  Lista Desbloqueados</a></td>
</tr>
<tr>
<td><a href="listaPorNivel.php"><img src="img\quad.jpg" width="9" align="center">  Lista Por Nivel</a></td>
</tr>
<tr>
<td><a href="listaPorSuperior.php"><img src="img\quad.jpg" width="9" align="center">  Lista Por Superior</a></td>
</tr>
<tr>
<td><a href="alterarSenha.php"><img src="img\quad.jpg" width="9" align="center">  Alterar Senha</a></td>
</tr>
<tr>
<td><a href="alterarPerfil.php"><img src="img\quad.jpg" width="9" align="center">  Alterar Perfil</a></td>
</tr>
<tr>
<td>&nbsp;</td>
</tr>
<?php 
}
?>
<tr>	
<td width="70%" align="center" valign="top">
<?php
$nome = $_GET['nome'];
$login = $_GET['login'];

$Usuario = new Usuario();
$Usuario->setNome($nome);
$Usuario->setLogin($login);
$UsuarioRepositorio = new UsuarioRepositorio();

if ($nome != ""){
    $Usuario = $UsuarioRepositorio->consultarUsuarioPorNome($Usuario);
}
else if ($login != ""){
    $Usuario = $UsuarioRepositorio->consultarUsuarioPorLogin($Usuario);
}

if($Usuario->getLogin() == ""){
    
    echo "USUARIO não encontrado";
}
else{
    
}
?>

<h3>Excluir Usuario Permanentemente</h3>
<form action="excluirUsuario3.php" method="get">
<label>Nome: </label>
<input readonly type="text" name="nome" size="25" value="<?php echo $Usuario->getNome(); ?>"><br/><br/>

<label>Login: </label>
<input readonly type="text" name="login" size="25" value="<?php echo $Usuario->getLogin(); ?>"><br/><br/>

<label>Nivel:</label>
<select name="nivel" disabled="disabled">
<option>Selecionar Nivel</option>
<option value="1" <?php If($Usuario->getNivel() == 1){
    echo "selected"; }?>>Administrador</option>

<option value="2" <?php if($Usuario->getNivel() == 2){
    echo "selected";}?>>Supervisor</option>

<option value="3" <?php if($Usuario->getNivel() == 3){
    echo "selected";}?>>Operador</option>
</select><br/><br/>

<label>Superior:</label>
<select name="idSuperior" disabled="disabled">
<option>Selecionar o Superior</option>
<?php 

$listaUsuario=$UsuarioRepositorio->listaUsuariosDesbloqueados();

$quant=$UsuarioRepositorio->contarTodosUsuariosDesbloqueado();
$contador= 0;

while($contador < $quant){
    
    $selected= "";
    $UsuarioAtual= $listaUsuario[$contador];
   if($UsuarioAtual->getId() == $Usuario->getIdSuperior()){
        $selected="selected";
    }
    
    echo "<option value='".
        $UsuarioAtual->getId()."' ".$selected.">".
        $UsuarioAtual->getNome()."</option>";
    
        $contador++;
}
 ?>
</select><br/><br/>
<input type="hidden" name="situacao" value="<?php echo $Usuario->getSituacao()?>" >
<input type="hidden" name="id" value="<?php echo $Usuario->getId()?>" >
<input type="submit" value="Excluir"/>
</form>
</td>		
</tr>

<tr style="background-color:#0D2263; color:#FFFFFF" >
<td coslpan="2" align="center">
<span>
<img width="55" src="img\logo2.png"/><br/>
	Av.joão de barros, N° 1593 - Espinheiro - Recife - PE, CEP 52.021-180<br/>
	(81) 31348100
</span>		
</td>
</tr>
</table>
</body>
</html>   
<?php 
}
?>   
