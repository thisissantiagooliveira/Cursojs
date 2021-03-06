<?php
session_start();

include_once 'src/Usuario.php';
include_once 'src/UsuarioRepositorio.php';

use src\Usuario;
use src\UsuarioRepositorio;

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
    
    echo "Unidade n??o encontrado";
}
else{
    
}
?>

<h3>Bloquear o Usuario do Sistema</h3>
<form action="bloquearUsuario3.php" method="get">
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
<input type="submit" value="Bloquear"/>
</form>
</body>
</html>   
<?php 
}
?> 
    